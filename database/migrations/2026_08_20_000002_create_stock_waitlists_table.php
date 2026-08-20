<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Daftar tunggu notifikasi "stok tersedia kembali".
     * Guest menyimpan email, user login otomatis memakai email akunnya.
     */
    public function up(): void
    {
        Schema::create('stock_waitlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('email');
            $table->timestamp('notified_at')->nullable();
            $table->timestamps();

            $table->unique(['product_id', 'email']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_waitlists');
    }
};