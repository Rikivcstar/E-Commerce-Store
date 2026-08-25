<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\SalesOrderService;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class XenditWebhookJob extends ProcessWebhookJob
{
    /**
     * Status invoice Xendit yang dianggap LUNAS.
     * Referensi: https://developers.xendit.co/api-reference/#invoice-object
     */
    protected array $paidStatuses = ['PAID', 'SETTLED'];

    /**
     * Proses callback pembayaran dari Xendit.
     */
    public function handle(): void
    {
        $webhookCall = $this->webhookCall;
        $payload = $webhookCall->payload;

        if (empty($payload)) {
            return;
        }

        // external_id diisi dengan trx_id saat membuat invoice di XenditPaymentDriver.
        $externalId = data_get($payload, 'external_id');

        if (! $externalId) {
            Log::warning('Xendit webhook diabaikan: external_id tidak ditemukan', [
                'payload' => $payload,
            ]);

            return;
        }

        $status = strtoupper((string) data_get($payload, 'status'));

        // Jangan lunasi order bila status bukan PAID / SETTLED.
        if (! in_array($status, $this->paidStatuses, true)) {
            Log::info('Xendit webhook diabaikan (status belum lunas)', [
                'external_id' => $externalId,
                'status' => $status,
            ]);

            return;
        }

        $paidAmount = (float) data_get($payload, 'paid_amount', 0);

        app(SalesOrderService::class)->approvePaymentUsingTrxId(
            (string) $externalId,
            $paidAmount
        );
    }
}
