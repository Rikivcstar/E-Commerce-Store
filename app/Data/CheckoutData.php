<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class CheckoutData extends Data
{
    #[Computed]
    public float $sub_total;

    #[Computed]
    public float $shipping_cost;

    #[Computed]
    public float $grand_total;

    public function __construct(
        public CustomerData $customer,
        public string $address_line,
        public RegionData $origin,
        public RegionData $destination,
        public CartData $cart,
        public ShippingData $shipping,
        public PaymentData $payment,
        public ?string $coupon_code = null,
        public float $discount_total = 0.0
    ) {
        $this->sub_total = $cart->total;
        $this->shipping_cost = $shipping->cost;
        $this->grand_total = $this->sub_total + $this->shipping_cost - $this->discount_total;
    }
}
