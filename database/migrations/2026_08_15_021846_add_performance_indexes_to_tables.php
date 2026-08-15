<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->index(['user_id', 'created_at']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->index(['stock', 'price']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index(['parent_id', 'is_active']);
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->index(['code', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'created_at']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['stock', 'price']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['parent_id', 'is_active']);
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->dropIndex(['code', 'is_active']);
        });
    }
};
