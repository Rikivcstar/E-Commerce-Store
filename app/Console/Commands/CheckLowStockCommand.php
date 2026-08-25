<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\LowStockAlertNotification;
use App\Services\SalesReportService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class CheckLowStockCommand extends Command
{
    protected $signature = 'app:check-low-stock {--threshold=5 : Batas stok menipis}';

    protected $description = 'Kirim peringatan stok menipis ke admin';

    public function handle(SalesReportService $service): int
    {
        $threshold = (int) $this->option('threshold');

        $products = $service->lowStockQuery($threshold)->get();

        if ($products->isEmpty()) {
            $this->info('Tidak ada produk dengan stok menipis.');

            return self::SUCCESS;
        }

        $admins = User::role(['super_admin', 'panel_user'])->get();

        if ($admins->isNotEmpty()) {
            Notification::send($admins, new LowStockAlertNotification($products));
        }

        $this->info("Peringatan stok menipis dikirim untuk {$products->count()} produk.");

        return self::SUCCESS;
    }
}
