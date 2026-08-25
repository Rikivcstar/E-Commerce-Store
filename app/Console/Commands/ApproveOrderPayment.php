<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\SalesOrder;
use App\Services\SalesOrderService;
use App\States\SalesOrder\Pending;
use Illuminate\Console\Command;

class ApproveOrderPayment extends Command
{
    protected $signature = 'order:approve-payment
                            {trx_id : ID transaksi (contoh: TRX-20260825-XXXXXX)}
                            {--force : Paksa approve meskipun status bukan Pending}';

    protected $description = '[DEV ONLY] Approve pembayaran order secara manual — dipakai saat webhook tidak bisa masuk ke localhost';

    public function handle(SalesOrderService $service): int
    {
        $trxId = $this->argument('trx_id');

        $order = SalesOrder::where('trx_id', $trxId)->first();

        if (! $order) {
            $this->error("Order [{$trxId}] tidak ditemukan.");

            return self::FAILURE;
        }

        if (! ($order->status instanceof Pending) && ! $this->option('force')) {
            $this->warn("Order [{$trxId}] bukan dalam status Pending (status saat ini: {$order->status}).");
            $this->warn('Gunakan --force untuk memaksa approve.');

            return self::FAILURE;
        }

        $this->info("Meng-approve pembayaran order [{$trxId}]...");

        $service->approvePaymentUsingTrxId($trxId, (float) $order->total);

        $order->refresh();

        $this->info("Berhasil! Status order sekarang: {$order->status}");

        return self::SUCCESS;
    }
}
