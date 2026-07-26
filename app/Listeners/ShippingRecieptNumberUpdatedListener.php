<?php

namespace App\Listeners;

use App\Events\ShippingRecieptNumberUpdateEvent;
use App\Mail\ShippingReceiptNumberUpdatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ShippingRecieptNumberUpdatedListener
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
    public function handle(ShippingRecieptNumberUpdateEvent $event): void
    {
        Mail::queue(
            new ShippingReceiptNumberUpdatedMail($event->sales_order)
        );
    }
}
