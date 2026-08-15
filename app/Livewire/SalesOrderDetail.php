<?php

namespace App\Livewire;

use App\Data\SalesOrderData;
use App\Models\SalesOrder;
use App\Services\PaymentMethodQueryService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SalesOrderDetail extends Component
{
    public SalesOrder $sales_order;

    public function mount(SalesOrder $sales_order): void
    {
        $this->sales_order = $sales_order;

        if ($this->sales_order->user_id !== null) {
            if (! Auth::check() || Auth::id() !== $this->sales_order->user_id) {
                abort(403, 'Anda tidak memiliki otorisasi untuk melihat pesanan ini.');
            }
        }
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
        ]);
    }
}
