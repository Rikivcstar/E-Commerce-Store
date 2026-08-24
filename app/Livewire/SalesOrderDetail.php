<?php

namespace App\Livewire;

use App\Data\SalesOrderData;
use App\Events\SalesOrderProofUploadedEvent;
use App\Models\SalesOrder;
use App\Services\PaymentMethodQueryService;
use App\Services\ShipmentTrackingService;
use App\States\SalesOrder\Cancel;
use App\States\SalesOrder\Pending;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class SalesOrderDetail extends Component
{
    use WithFileUploads;

    public SalesOrder $sales_order;

    public $proof;

    protected function rules(): array
    {
        return [
            'proof' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ];
    }

    public function mount(SalesOrder $sales_order): void
    {
        $this->sales_order = $sales_order;

        $this->authorizeAccess();
    }

    /**
     * Pesanan punya pemilik hanya jika user_id terisi (akun / sudah ditautkan).
     * Order tamu tetap bisa diakses lewat tautan untuk konfirmasi & pembatalan.
     */
    protected function authorizeAccess(): void
    {
        if ($this->sales_order->user_id === null) {
            return;
        }

        if (! Auth::check() || Auth::id() !== $this->sales_order->user_id) {
            abort(403, 'Anda tidak memiliki otorisasi untuk melihat pesanan ini.');
        }
    }

    public function cancelOrder(): void
    {
        $this->authorizeAccess();

        abort_unless(
            $this->sales_order->status instanceof Pending,
            403,
            'Pesanan hanya dapat dibatalkan saat masih menunggu pembayaran.'
        );

        $this->sales_order->status->transitionTo(Cancel::class);

        toast('Pesanan berhasil dibatalkan. Stok produk telah dikembalikan.', 'success');
    }

    public function uploadProof(): void
    {
        abort_unless(
            $this->sales_order->status instanceof Pending,
            403,
            'Bukti transfer hanya dapat diunggah saat pesanan masih menunggu pembayaran.'
        );

        abort_unless(
            $this->sales_order->payment_driver === 'offline',
            403,
            'Pembayaran online tidak memerlukan unggah bukti transfer.'
        );

        $this->validate();

        $this->sales_order->clearMediaCollection('proof_of_payment');

        $this->sales_order
            ->addMedia($this->proof->getRealPath())
            ->toMediaCollection('proof_of_payment');

        $this->proof = null;

        toast('Bukti transfer berhasil diunggah. Kami akan segera memverifikasi pembayaran Anda.', 'success');

        event(new SalesOrderProofUploadedEvent(
            SalesOrderData::fromModel($this->sales_order)
        ));
    }

    public function getProofUrlProperty(): ?string
    {
        return $this->sales_order->getFirstMediaUrl('proof_of_payment');
    }

    public function render()
    {
        $service = app(PaymentMethodQueryService::class);
        $sales_order_data = SalesOrderData::fromModel($this->sales_order);

        return view('livewire.sales-order-detail', [
            'order' => $sales_order_data,
            'timeline' => $this->sales_order->status_timeline,
            'is_redirect' => $service->shouldShowButton($sales_order_data),
            'redirect_url' => $service->getRedirectUrl($sales_order_data),
            'can_claim_order' => $this->sales_order->user_id === null && ! Auth::check(),
            'can_download_invoice' => Auth::check() && (int) $this->sales_order->user_id === (int) Auth::id(),
            'tracking_url' => app(ShipmentTrackingService::class)
                ->getUrl($sales_order_data->shipping->courier, $sales_order_data->shipping->receipt_number),
        ]);
    }
}
