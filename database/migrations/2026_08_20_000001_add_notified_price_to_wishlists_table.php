<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom harga terakhir yang pernah di-notifikasi ke pengguna
     * sebagai baseline untuk deteksi penurunan harga wishlist.
     */
    public function up(): void
    {
        Schema::table('wishlists', function (Blueprint $table) {
            $table->decimal('notified_price', 11, 2)->nullable()->after('product_id');
        });
    }

    public function down(): void
    {
        Schema::table('wishlists', function (Blueprint $table) {
            $table->dropColumn('notified_price');
        });
    }
};