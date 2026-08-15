<?php

namespace App\Listeners;

use App\Events\SalesOrderProgressedEvent;
use App\Mail\SalesOrderProgressedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SalesOrderProgressedListener implements ShouldQueue
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
    public function handle(SalesOrderProgressedEvent $event): void
    {
        Mail::to($event->sales_order->customer->email)
            ->queue(new SalesOrderProgressedMail($event->sales_order));
    }
}
