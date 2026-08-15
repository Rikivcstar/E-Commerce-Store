<?php

namespace App\Filament\Widgets;

use App\Services\SalesReportService;
use Filament\Widgets\ChartWidget;

class OrderStatusChartWidget extends ChartWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 1;

    protected ?string $maxHeight = '300px';

    public function getHeading(): ?string
    {
        return 'Status Pesanan';
    }

    protected function getData(): array
    {
        $service = app(SalesReportService::class);
        $ordersByStatus = $service->ordersByStatus();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pesanan',
                    'data' => [
                        $ordersByStatus['pending'],
                        $ordersByStatus['progress'],
                        $ordersByStatus['completed'],
                        $ordersByStatus['cancel'],
                    ],
                    'backgroundColor' => [
                        '#f59e0b', // Pending (Amber)
                        '#3b82f6', // Progress (Blue)
                        '#10b981', // Completed (Emerald)
                        '#ef4444', // Cancel (Red)
                    ],
                    'hoverOffset' => 4,
                ],
            ],
            'labels' => ['Menunggu (Pending)', 'Diproses (Progress)', 'Selesai (Completed)', 'Dibatalkan (Cancel)'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
