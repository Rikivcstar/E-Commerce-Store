<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Data\SalesOrderData;
use App\Models\SalesOrder;
use App\Services\PaymentMethodQueryService;
use Illuminate\Console\Command;

class RetryXenditInvoice extends Command
{
    protected $signature = 'xendit:retry-invoice {trx_id : ID transaksi (contoh: TRX-20260825-XXXXXX)}';

    protected $description = 'Retry pembuatan Xendit invoice untuk order yang gagal mendapat payment link';

    public function handle(PaymentMethodQueryService $service): int
    {
        $trxId = $this->argument('trx_id');

        $order = SalesOrder::where('trx_id', $trxId)->first();

        if (! $order) {
            $this->error("Order dengan TRX ID [{$trxId}] tidak ditemukan.");

            return self::FAILURE;
        }

        $data = SalesOrderData::fromModel($order);

        if ($data->payment->driver !== 'xendit') {
            $this->error("Order ini menggunakan driver [{$data->payment->driver}], bukan xendit.");

            return self::FAILURE;
        }

        $this->info("Membuat Xendit invoice untuk order [{$trxId}]...");

        $result = $service->getDriver($data->payment)->process($data);

        if (! $result) {
            $this->error('Gagal membuat invoice. Cek laravel.log untuk detail error Xendit API.');

            return self::FAILURE;
        }

        $url = data_get($result->payment->payload, 'xendit_payload.invoice_url');
        $this->info("Berhasil! Invoice URL: {$url}");

        return self::SUCCESS;
    }
}
