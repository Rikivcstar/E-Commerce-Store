<?php

namespace App\Livewire;

use App\Contract\CartServiceInterface;
use App\Data\CartData;
use App\Data\CheckoutData;
use App\Data\CustomerData;
use App\Data\RegionData;
use App\Data\ShippingData;
use App\Rules\ValidPaymentMethodHash;
use App\Rules\ValidShippingHash;
use App\Services\CheckoutService;
use App\Services\PaymentMethodQueryService;
use App\Services\RegionQueryService;
use App\Services\ShippingMethodService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Number;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Spatie\LaravelData\DataCollection;

#[Lazy]
class Checkout extends Component
{
    public array $data = [
        'full_name' => null,
        'email' => null,
        'phone' => null,
        'address_line' => null,
        'destination_region_code' => null,
        'shipping_hash' => null,
        'payment_method_hash' => null,
    ];

    public string $coupon_input = '';

    public array $summary = [
        'sub_total' => null,
        'sub_total_formatted' => '-',
        'shipping_total' => null,
        'shipping_total_formatted' => '-',
        'discount_total' => 0.0,
        'discount_total_formatted' => 'Rp 0',
        'coupon_code' => null,
        'grand_total' => null,
        'grand_total_formatted' => '-',
    ];

    public array $payment_method_selector = [
        'payment_method_selected' => null,
    ];

    public array $region_selector = [
        'keyword' => null,
        'region_selected' => null,
    ];

    public array $address_selector = [
        'address_id' => null,
    ];

    public function placeholder()
    {
        return view('livewire.checkout-skeleton');
    }

    public function rules()
    {
        return [
            'data.full_name' => ['required', 'string', 'max:255',  'min:3'],
            'data.email' => ['required', 'email', 'max:255', 'min:3'],
            'data.phone' => ['required', 'string', 'max:13', 'min:7'],
            'data.address_line' => ['required', 'string', 'max:500'],
            'data.destination_region_code' => ['required', 'exists:regions,code'],
            'data.shipping_hash' => ['required', new ValidShippingHash],
            'data.payment_method_hash' => ['required', new ValidPaymentMethodHash],
        ];
    }

    protected function ValidationAttributes()
    {
        return
        [
            'data.full_name' => 'Name',
            'data.email' => 'Email',
            'data.phone' => 'Phone',
            'data.address_line' => 'Address',
            'data.destination_region_code' => 'Region',
            'data.shipping_hash' => 'Shipping Method',
            'data.payment_method_hash' => 'Payment Method',
        ];
    }

    public function mount()
    {
        if (! Gate::inspect('is_stock_available')->allow()) {
            return redirect()->route('cart');
        }

        $this->calculateTotal();
    }

    public function getRegionsProperty(RegionQueryService $query_service): DataCollection
    {

        $keyword = data_get($this->region_selector, 'keyword');

        if (! $keyword) {
            return new DataCollection(RegionData::class, []);
        }

        return $query_service->searchRegionByName(
            (string) $keyword
        );

    }

    public function getRegionProperty(RegionQueryService $query_service): ?RegionData
    {
        $region_selected = data_get($this->region_selector, 'region_selected');
        if (! $region_selected) {
            return null;
        }

        return $query_service->searchRegionByCode((string) $region_selected);
    }

    public function updatedRegionSelectorRegionSelected($value)
    {
        $this->selectDestinationRegion((string) $value);
    }

    public function getSavedAddressesProperty(): \Illuminate\Support\Collection
    {
        if (! auth()->check()) {
            return collect();
        }

        return auth()->user()->addresses()->get();
    }

    public function applyAddress(): void
    {
        $addressId = data_get($this->address_selector, 'address_id');

        if (! $addressId) {
            return;
        }

        $address = auth()->user()->addresses()->findOrFail((int) $addressId);

        data_set($this->data, 'full_name', $address->full_name);
        data_set($this->data, 'phone', $address->phone);
        data_set($this->data, 'address_line', $address->address_line);

        $this->selectDestinationRegion($address->region_code);

        toast('Alamat diterapkan.', 'success');
    }

    protected function selectDestinationRegion(string $region_code): void
    {
        data_set($this->data, 'destination_region_code', $region_code);
        data_set($this->data, 'shipping_hash', null);
        data_set($this->region_selector, 'region_selected', $region_code);
        $this->calculateTotal();
    }

    public function applyCoupon(): void
    {
        $code = trim(strtoupper($this->coupon_input));

        if (empty($code)) {
            $this->addError('coupon_input', 'Masukan kode kupon.');

            return;
        }

        $coupon = \App\Models\Coupon::where('code', $code)->first();

        if (! $coupon) {
            $this->addError('coupon_input', 'Kode kupon tidak ditemukan.');
            toast('Kode kupon tidak valid.', 'error');

            return;
        }

        if (! $coupon->isValid($this->cart->total)) {
            $this->addError('coupon_input', 'Kupon tidak memenuhi syarat atau sudah kadaluarsa/habis.');
            toast('Kupon tidak memenuhi syarat atau sudah kadaluarsa.', 'error');

            return;
        }

        data_set($this->summary, 'coupon_code', $coupon->code);
        $this->coupon_input = '';
        $this->resetErrorBag('coupon_input');
        $this->calculateTotal();

        toast("Kupon {$coupon->code} berhasil diterapkan!", 'success');
    }

    public function removeCoupon(): void
    {
        data_set($this->summary, 'coupon_code', null);
        $this->coupon_input = '';
        $this->calculateTotal();
        toast('Kupon dibatalkan.', 'info');
    }

    public function calculateTotal()
    {
        $subTotal = $this->cart->total;
        data_set($this->summary, 'sub_total', $subTotal);
        data_set($this->summary, 'sub_total_formatted', $this->cart->total_formatted);

        $shipping_cost = $this->shippingMethod?->cost ?? 0;
        data_set($this->summary, 'shipping_total', $shipping_cost);
        data_set($this->summary, 'shipping_total_formatted', Number::currency($shipping_cost, 'IDR'));

        $discountTotal = 0.0;
        $couponCode = data_get($this->summary, 'coupon_code');

        if ($couponCode) {
            $coupon = \App\Models\Coupon::where('code', $couponCode)->first();
            if ($coupon && $coupon->isValid($subTotal)) {
                $discountTotal = $coupon->discountFor($subTotal);
            } else {
                data_set($this->summary, 'coupon_code', null);
            }
        }

        data_set($this->summary, 'discount_total', $discountTotal);
        data_set($this->summary, 'discount_total_formatted', Number::currency($discountTotal, 'IDR'));

        $grand_total = max(0, $subTotal + $shipping_cost - $discountTotal);
        data_set($this->summary, 'grand_total', $grand_total);
        data_set($this->summary, 'grand_total_formatted', Number::currency($grand_total, 'IDR'));
    }

    public function getCartProperty(CartServiceInterface $cart): CartData
    {
        return $cart->all();
    }

    public function getCurrentStepProperty(): int
    {
        if (data_get($this->data, 'shipping_hash')) {
            return 3;
        }

        if (data_get($this->data, 'destination_region_code')) {
            return 2;
        }

        return 1;
    }

    /** @return Collection<string, Collection<int, ShippingData>> */
    public function getShippingMethodsProperty(
        RegionQueryService $region_query,
        ShippingMethodService $shipping_service
    ): Collection {

        $destination_code = data_get($this->data, 'destination_region_code');

        if (! $destination_code) {
            return collect();
        }

        $origin_code = config('shipping.shipping_origin_code');

        return $shipping_service->getShippingMethods(
            $region_query->searchRegionByCode((string) $origin_code),
            $region_query->searchRegionByCode((string) $destination_code),
            $this->cart,
        )->toCollection()->groupBy('service');
    }

    public function getShippingMethodProperty(
        ShippingMethodService $shipping_service
    ): ?ShippingData {
        if (
            empty(data_get($this->data, 'shipping_hash')) ||
            empty(data_get($this->data, 'destination_region_code'))
        ) {
            return null;
        }

        $shipping_hash = data_get($this->data, 'shipping_hash');

        $data = $shipping_service->getShippingMethod(
            (string) $shipping_hash
        );

        if ($data == null) {
            $this->addError('shipping_hash', 'Shipping Cost Missing');
            redirect()->route('checkout');
        }

        return $data;
    }

    public function getPaymentMethodsProperty(
        PaymentMethodQueryService $query_service
    ): DataCollection {
        return $query_service->getPaymentMethods();
    }

    public function updatedPaymentMethodSelectorPaymentMethodSelected($value)
    {
        data_set($this->data, 'payment_method_hash', $value);
    }

    public function updatedDataShippingHash()
    {
        $this->calculateTotal();
    }

    public function placeAnOrder(
        CartServiceInterface $cart
    ) {
        $validate = $this->validate();
        $shipping_method = app(ShippingMethodService::class)->getShippingMethod(data_get($validate, 'data.shipping_hash')
        );

        $payment_method = app(PaymentMethodQueryService::class)->getPaymentMethodByHash(data_get($validate, 'data.payment_method_hash')
        );

        $checkout = CheckoutData::from([
            'customer' => CustomerData::from(data_get($validate, 'data')),
            'address_line' => data_get($validate, 'data.address_line'),
            'origin' => $shipping_method->origin,
            'destination' => $shipping_method->destination,
            'cart' => $this->cart,
            'shipping' => $shipping_method,
            'payment' => $payment_method,
            'coupon_code' => data_get($this->summary, 'coupon_code'),
            'discount_total' => (float) data_get($this->summary, 'discount_total', 0.0),
        ]);

        $service = app(CheckoutService::class);
        $sales_order = $service->makeAndOrder($checkout);
        $cart->clear();

        return redirect()->route('order-confirmed', $sales_order->trx_id);
    }

    public function render()
    {
        return view('livewire.checkout', [
            'cart' => $this->cart,
            'summary' => $this->summary,
        ]);
    }
}
