<?php

declare(strict_types=1);

namespace App\Drivers\Payment;

use App\Contract\PaymentDriverInterface;
use App\Data\PaymentData;
use App\Data\SalesOrderData;
use App\Data\SalesOrderItemData;
use App\Services\SalesOrderService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\DataCollection;

class XenditPaymentDriver implements PaymentDriverInterface
{
    public readonly string $driver;

    public function __construct()
    {
        $this->driver = 'xendit';
    }

    /** @return DataCollection<PaymentData> */
    public function getMethods(): DataCollection
    {
        return PaymentData::collect([
            PaymentData::from([
                'driver' => 'xendit',
                'method' => 'xendit-invoice',
                'label' => 'Xendit (QRIS, VA, E-Wallet)',
                'payload' => [],
                'logo_url' => url('images/payments/xendit.png'),
            ]),
        ], DataCollection::class);
    }

    public function process(SalesOrderData $sales_order)
    {
        $secretKey = config('services.xendit.secret_key');

        $items = $sales_order->items->toCollection()->map(function (SalesOrderItemData $item) {
            return [
                'name' => $item->name,
                'quantity' => $item->quantity,
                'price' => (int) $item->price,
            ];
        })->merge([
            [
                'name' => "Ongkir ({$sales_order->shipping->courier})",
                'quantity' => 1,
                'price' => (int) $sales_order->shipping_cost,
            ],
        ])->toArray();

        $response = Http::withBasicAuth($secretKey, '')
            ->post('https://api.xendit.co/v2/invoices', [
                'external_id' => $sales_order->trx_id,
                'amount' => (int) $sales_order->total,
                'description' => "Pembayaran Order {$sales_order->trx_id}",
                'currency' => 'IDR',
                'payer_email' => $sales_order->customer->email,
                'customer' => [
                    'given_names' => $sales_order->customer->full_name,
                    'email' => $sales_order->customer->email,
                    'mobile_number' => $sales_order->customer->phone,
                ],
                'items' => $items,
                'success_redirect_url' => route('order-confirmed', $sales_order->trx_id),
                'failure_redirect_url' => route('order-confirmed', $sales_order->trx_id),
            ]);

        if ($response->failed()) {
            Log::error('Xendit create invoice gagal', [
                'trx_id' => $sales_order->trx_id,
                'status' => $response->status(),
                'response' => $response->json(),
            ]);

            return null;
        }

        return app(SalesOrderService::class)->updateShippingPayload($sales_order, [
            'xendit_payload' => $response->json(),
        ]);
    }

    public function shouldShowPayNowButton(SalesOrderData $sales_order): bool
    {
        $url = data_get($sales_order->payment->payload, 'xendit_payload.invoice_url');

        return ! empty($url);
    }

    public function getRedirectUrl(SalesOrderData $sales_order): ?string
    {
        return data_get($sales_order->payment->payload, 'xendit_payload.invoice_url');
    }
}
