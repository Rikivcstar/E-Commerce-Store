<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\SalesOrderData;
use App\Data\SalesOrderItemData;
use App\Events\ShippingReceiptNumberUpdateEvent;
use App\Models\Product;
use App\Models\SalesOrder;
use App\States\SalesOrder\Pending;
use App\States\SalesOrder\Progress;
use Illuminate\Support\Facades\DB;

class SalesOrderService
{
    public function updateShippingReceipt(SalesOrderData $sales_order, string $number): SalesOrderData
    {
        $query = SalesOrder::query()->where('trx_id', $sales_order->trx_id)->first();

        $query->update([
            'shipping_receipt_number' => $number,
        ]);

        $data = SalesOrderData::fromModel(
            $query->refresh()
        );

        event(new ShippingReceiptNumberUpdateEvent($data));

        return $data;
    }

    public function updateShippingPayload(SalesOrderData $sales_order, array $payload): SalesOrderData
    {
        SalesOrder::where('trx_id', $sales_order->trx_id)->update([
            'payment_payload' => array_merge($sales_order->payment->payload, $payload),
        ]);

        return SalesOrderData::fromModel(
            SalesOrder::where('trx_id', $sales_order->trx_id)->first()
        );
    }

    public function returnStock(SalesOrderData $sales_order): void
    {
        DB::transaction(function () use ($sales_order) {
            $sales_order->items->toCollection()->each(function (SalesOrderItemData $item) {
                Product::query()
                    ->where('sku', $item->sku)
                    ->lockForUpdate()
                    ->increment('stock', $item->quantity);
            });
        });
    }

    public function approvePaymentUsingTrxId(
        string $trx_id,
        float $total = 0
    ): void {
        DB::transaction(function () use ($trx_id, $total) {
            $sales_order = SalesOrder::query()
                ->where('trx_id', $trx_id)
                ->lockForUpdate()
                ->first();

            if (! $sales_order) {
                \Illuminate\Support\Facades\Log::warning('SalesOrder not found for TRX ID: '.$trx_id);

                return;
            }

            if (! ($sales_order->status instanceof Pending)) {
                \Illuminate\Support\Facades\Log::info('SalesOrder already processed or not in pending state for TRX ID: '.$trx_id);

                return;
            }

            // Verifikasi jumlah pembayaran terhadap total order (jika jumlah tersedia di payload).
            if ($total > 0 && $total < $sales_order->total) {
                \Illuminate\Support\Facades\Log::warning('Pembayaran lebih kecil dari total order', [
                    'trx_id' => $trx_id,
                    'paid' => $total,
                    'expected' => $sales_order->total,
                ]);

                return;
            }

            $sales_order->status->transitionTo(Progress::class);
            \Illuminate\Support\Facades\Log::info('SalesOrder payment approved via webhook for TRX ID: '.$trx_id);
        });
    }
}
