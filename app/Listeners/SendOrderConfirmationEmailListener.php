<?php

namespace App\Listeners;

use App\Events\SalesOrderCreatedEvent;
use App\Mail\SalesOrderCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmationEmailListener implements ShouldQueue
{
    use InteractsWithQueue;

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
        Mail::to($event->sales_order->customer->email)
            ->queue(new SalesOrderCreatedMail($event->sales_order));
    }
}
