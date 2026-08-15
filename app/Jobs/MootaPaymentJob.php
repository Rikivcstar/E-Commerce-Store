<?php

namespace App\Jobs;

use App\Services\SalesOrderService;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class MootaPaymentJob extends ProcessWebhookJob
{
    /**
     * Status pembayaran yang dianggap LUNAS.
     */
    protected array $paidStatuses = ['success', 'paid', 'completed', 'settlement', 'captured', 'cr'];

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $webhookCall = $this->webhookCall;
        $rawPayload = $webhookCall->payload;

        if (empty($rawPayload)) {
            return;
        }

        // Handle array of items vs single item object
        $items = isset($rawPayload[0]) && is_array($rawPayload[0]) ? $rawPayload : [$rawPayload];

        foreach ($items as $item) {
            if (! is_array($item)) {
                continue;
            }

            $trxId = data_get($item, 'payment_detail.trx_id')
                ?? data_get($item, 'payment_detail.order_id')
                ?? data_get($item, 'trx_id')
                ?? data_get($item, 'order_id');

            if (! $trxId) {
                continue;
            }

            $status = strtolower((string) (data_get($item, 'payment_detail.status') ?? data_get($item, 'status')));

            // Jangan lunasi order bila status eksplisit menunjukkan pembayaran belum sukses.
            if ($status !== '' && ! in_array($status, $this->paidStatuses, true)) {
                Log::info('Moota webhook diabaikan (status belum lunas)', [
                    'trx_id' => $trxId,
                    'status' => $status,
                ]);

                continue;
            }

            $total = (float) (data_get($item, 'payment_detail.amount_captured')
                ?? data_get($item, 'payment_detail.total')
                ?? data_get($item, 'amount')
                ?? data_get($item, 'total')
                ?? 0);

            app(SalesOrderService::class)->approvePaymentUsingTrxId(
                (string) $trxId,
                $total
            );
        }
    }
}
