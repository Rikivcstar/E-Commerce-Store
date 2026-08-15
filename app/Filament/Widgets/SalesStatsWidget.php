<?php

namespace App\Filament\Widgets;

use App\Services\SalesReportService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class SalesStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $service = app(SalesReportService::class);
        $stats = $service->monthlyStats();
        $ordersByStatus = $service->ordersByStatus();

        return [
            Stat::make('Pendapatan Bulan Ini', Number::currency($stats['revenue'], 'IDR'))
                ->description('Total omset transaksi berhasil')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($service->revenueSparkline(7))
                ->color('success'),

            Stat::make('Total Pesanan', $stats['order_count'].' Transaksi')
                ->description("Pending: {$ordersByStatus['pending']} | Proses: {$ordersByStatus['progress']}")
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->chart($service->ordersSparkline(7))
                ->color('warning'),

            Stat::make('Produk Terjual', $stats['items_sold'].' Pcs')
                ->description('Total unit dikirim bulan ini')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->chart($service->itemsSoldSparkline(7))
                ->color('info'),

            Stat::make('Pelanggan Baru', $stats['new_customers'].' User')
                ->description('User terdaftar bulan ini')
                ->descriptionIcon('heroicon-m-user-plus')
                ->chart($service->customersSparkline(7))
                ->color('primary'),
        ];
    }
}
