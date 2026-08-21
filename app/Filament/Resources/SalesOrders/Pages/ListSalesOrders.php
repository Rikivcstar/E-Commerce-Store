<?php

namespace App\Filament\Resources\SalesOrders\Pages;

use App\Filament\Resources\SalesOrders\SalesOrderResource;
use App\Models\SalesOrder;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListSalesOrders extends ListRecords
{
    protected static string $resource = SalesOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export_csv')
                ->label('Export CSV')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->tooltip('Unduh seluruh pesanan sebagai file CSV')
                ->action(function () {
                    $headers = [
                        'TRX ID', 'Tanggal', 'Status', 'Nama Pelanggan', 'Email', 'Telepon', 'Alamat',
                        'Kurir', 'Resi', 'Metode Pembayaran', 'Subtotal', 'Diskon', 'Ongkir', 'Total',
                    ];

                    return response()->streamDownload(function () use ($headers) {
                        $handle = fopen('php://output', 'w');

                        fputcsv($handle, $headers);

                        SalesOrder::query()
                            ->with('items')
                            ->orderBy('created_at', 'desc')
                            ->chunk(500, function ($orders) use ($handle) {
                                foreach ($orders as $order) {
                                    fputcsv($handle, [
                                        $order->trx_id,
                                        $order->created_at->format('Y-m-d H:i:s'),
                                        $order->status->label(),
                                        $order->customer_full_name,
                                        $order->customer_email,
                                        $order->customer_phone,
                                        $order->address_line,
                                        strtoupper($order->shipping_courier),
                                        $order->shipping_receipt_number ?? '',
                                        $order->payment_label,
                                        (float) $order->sub_total,
                                        (float) ($order->discount_total ?? 0),
                                        (float) $order->shipping_total,
                                        (float) $order->total,
                                    ]);
                                }
                            });

                        fclose($handle);
                    }, 'sales-orders-'.now()->format('Y-m-d_His').'.csv');
                }),
        ];
    }
}