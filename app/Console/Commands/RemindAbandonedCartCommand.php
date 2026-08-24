<?php

namespace App\Console\Commands;

use App\Mail\AbandonedCartMail;
use App\Models\CartReminder;
use App\Models\UserCartItem;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class RemindAbandonedCartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cart:remind-abandoned';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim email pengingat ke user dengan keranjang yang ditinggalkan lebih dari 24 jam';

    private const IDLE_HOURS = 24;

    private const REMINDER_COOLDOWN_DAYS = 3;

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $cutoff = now()->subHours(self::IDLE_HOURS);
        $cooldown = now()->subDays(self::REMINDER_COOLDOWN_DAYS);

        $userIds = UserCartItem::query()
            ->where('updated_at', '<=', $cutoff)
            ->distinct()
            ->pluck('user_id');

        if ($userIds->isEmpty()) {
            $this->info('Tidak ada keranjang terlantar.');

            return self::SUCCESS;
        }

        $sent = 0;

        foreach ($userIds as $userId) {
            $items = UserCartItem::query()
                ->where('user_id', $userId)
                ->where('updated_at', '<=', $cutoff)
                ->get()
                ->map(function (UserCartItem $row) {
                    $product = Product::query()->where('sku', $row->sku)->first();

                    if (! $product) {
                        return null;
                    }

                    return (object) [
                        'name' => $product->name,
                        'quantity' => $row->quantity,
                        'price_formatted' => \Illuminate\Support\Number::currency($product->effective_price),
                        'cover_url' => $product->cover_url,
                        'slug' => $product->slug,
                    ];
                })
                ->filter()
                ->values();

            if ($items->isEmpty()) {
                continue;
            }

            $alreadyReminded = CartReminder::query()
                ->where('user_id', $userId)
                ->where('reminded_at', '>=', $cooldown)
                ->exists();

            if ($alreadyReminded) {
                continue;
            }

            $user = \App\Models\User::find($userId);

            if (! $user || empty($user->email)) {
                continue;
            }

            Mail::to($user->email)->queue(new AbandonedCartMail($user->name, $items));

            CartReminder::create([
                'user_id' => $userId,
                'reminded_at' => Carbon::now(),
            ]);

            $sent++;
        }

        $this->info("Pengingat keranjang terkirim ke {$sent} user.");

        return self::SUCCESS;
    }
}