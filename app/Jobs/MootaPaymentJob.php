<?php

namespace App\Jobs;

use App\Services\SalesOrderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class MootaPaymentJob extends ProcessWebhookJob
{
     /**
     * Execute the job.
     */
    public function handle(): void
    {
         $data = $this->webhookCall;

         collect(data_get($data, 'payload'))->each(function ($item) {
            $order_id = data_get($item, 'payment_detail.order_id') ?? data_get($item, 'payment_detail.trx_id');
            if (!$order_id) {
                return;
            }

            $total = data_get($item, 'payment_detail.total', data_get($item, 'amount'));
            $unique_code = data_get($item, 'payment_detail.unique_code', 0);
            $real_total = (float) $total - (float) $unique_code;

            app(SalesOrderService::class)->approvePaymentUsingTrxId(
                (string) $order_id,
                $real_total
            );
         });
    }
}
