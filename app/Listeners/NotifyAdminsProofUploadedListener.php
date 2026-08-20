<?php

namespace App\Listeners;

use App\Events\SalesOrderProofUploadedEvent;
use App\Models\SalesOrder;
use App\Models\User;
use App\Notifications\ProofOfPaymentUploadedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NotifyAdminsProofUploadedListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(SalesOrderProofUploadedEvent $event): void
    {
        $salesOrder = SalesOrder::query()->where('trx_id', $event->sales_order->trx_id)->first();

        if (! $salesOrder) {
            return;
        }

        $admins = User::role(['super_admin', 'panel_user'])->get();

        if ($admins->isNotEmpty()) {
            Notification::send($admins, new ProofOfPaymentUploadedNotification($salesOrder));
        }
    }
}