<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Keranjang belanja berbasis akun agar bisa disinkron antar perangkat
     * dan digabung (merge) dengan cart guest saat login.
     */
    public function up(): void
    {
        Schema::create('user_cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('sku');
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();

            $table->unique(['user_id', 'sku']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_cart_items');
    }
};