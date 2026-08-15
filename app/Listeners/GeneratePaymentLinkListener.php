<?php

namespace App\Listeners;

use App\Events\SalesOrderCreatedEvent;
use App\Services\PaymentMethodQueryService;

class GeneratePaymentLinkListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SalesOrderCreatedEvent $event): void
    {
        try {
            app(PaymentMethodQueryService::class)
                ->getDriver(
                    $event->sales_order->payment
                )->process(
                    $event->sales_order
                );
        } catch (\Throwable $e) {
            // Kegagalan pembuatan payment link tidak boleh menggagalkan checkout.
            \Illuminate\Support\Facades\Log::error('Gagal membuat payment link untuk order '.$event->sales_order->trx_id, [
                'exception' => $e->getMessage(),
            ]);
        }
    }
}
