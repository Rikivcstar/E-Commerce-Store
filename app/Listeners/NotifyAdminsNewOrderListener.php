<?php

namespace App\Listeners;

use App\Events\SalesOrderCreatedEvent;
use App\Models\SalesOrder;
use App\Models\User;
use App\Notifications\NewSalesOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NotifyAdminsNewOrderListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(SalesOrderCreatedEvent $event): void
    {
        // SalesOrderData tidak membawa id — cocokkan lewat trx_id yang unik.
        $salesOrder = SalesOrder::query()->where('trx_id', $event->sales_order->trx_id)->first();

        if (! $salesOrder) {
            return;
        }

        $admins = User::role(['super_admin', 'panel_user'])->get();

        if ($admins->isNotEmpty()) {
            Notification::send($admins, new NewSalesOrderNotification($salesOrder));
        }
    }
}
