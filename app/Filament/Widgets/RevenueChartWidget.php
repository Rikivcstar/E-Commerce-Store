<?php

namespace App\Filament\Widgets;

use App\Services\SalesReportService;
use Filament\Widgets\ChartWidget;

class RevenueChartWidget extends ChartWidget
{
    protected static ?int $sort = 2;

    public ?string $filter = '30';

    public function getHeading(): ?string
    {
        return 'Grafik Omset Pendapatan';
    }

    protected function getFilters(): ?array
    {
        return [
            '7' => '7 Hari Terakhir',
            '30' => '30 Hari Terakhir',
            '90' => '90 Hari Terakhir',
        ];
    }

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $service = app(SalesReportService::class);
        $days = (int) ($this->filter ?? 30);
        $chartData = $service->revenueByDay($days);

        return [
            'datasets' => [
                [
                    'label' => 'Omset (Rp)',
                    'data' => $chartData['data'],
                    'fill' => 'start',
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.15)',
                    'tension' => 0.4,
                    'pointBackgroundColor' => '#f59e0b',
                    'pointHoverBackgroundColor' => '#ffffff',
                    'pointHoverBorderColor' => '#f59e0b',
                    'pointHoverBorderWidth' => 3,
                    'pointRadius' => 3,
                ],
            ],
            'labels' => $chartData['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
