<?php

namespace App\Console\Commands;

use App\Mail\WishlistPriceDropMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class WishlistPriceDropCommand extends Command
{
    protected $signature = 'wishlist:check-price-drop';

    protected $description = 'Kirim notifikasi harga turun untuk item di wishlist pengguna';

    public function handle(): int
    {
        $rows = DB::table('wishlists')
            ->join('products', 'products.id', '=', 'wishlists.product_id')
            ->join('users', 'users.id', '=', 'wishlists.user_id')
            ->where('products.stock', '>', 0)
            ->select(
                'wishlists.id',
                'wishlists.user_id',
                'wishlists.notified_price',
                'products.name',
                'products.slug',
                'products.price',
            )
            ->get();

        $notified = 0;

        foreach ($rows as $row) {
            $price = (float) $row->price;

            // Baseline awal: simpan harga saat peluncuran fitur tanpa mengirim email.
            if ($row->notified_price === null) {
                DB::table('wishlists')->where('id', $row->id)->update(['notified_price' => $price]);

                continue;
            }

            $baseline = (float) $row->notified_price;

            if ($price < $baseline) {
                $user = User::find($row->user_id);

                if ($user) {
                    Mail::to($user)->queue(new WishlistPriceDropMail(
                        name: $row->name,
                        slug: $row->slug,
                        oldPrice: $baseline,
                        newPrice: $price,
                    ));

                    $notified++;
                }
            }

            // Selalu perbarui baseline ke harga terakhir yang dilihat,
            // sehingga hanya penurunan ke harga terendah baru yang memicu notifikasi.
            DB::table('wishlists')->where('id', $row->id)->update(['notified_price' => $price]);
        }

        $this->info("Wishlist price drop: {$notified} notifikasi terkirim.");

        return self::SUCCESS;
    }
}