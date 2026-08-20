<?php

namespace App\Listeners;

use App\Events\ProductRestockedEvent;
use App\Mail\StockAvailableMail;
use App\Models\StockWaitlist;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyStockWaitlistListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ProductRestockedEvent $event): void
    {
        StockWaitlist::query()
            ->where('product_id', $event->product->id)
            ->whereNull('notified_at')
            ->get()
            ->each(function (StockWaitlist $waitlist): void {
                $email = $waitlist->user_id ? $waitlist->user?->email : $waitlist->email;

                if (! $email) {
                    return;
                }

                Mail::to($email)->queue(new StockAvailableMail($event->product));

                $waitlist->update(['notified_at' => now()]);
            });
    }
}