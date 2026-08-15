<?php

namespace Tests\Feature;

use App\Models\Coupon;
use App\Services\CouponService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class CouponServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_resolve_returns_running_coupon(): void
    {
        Coupon::create([
            'code' => 'HEMAT10',
            'type' => 'percent',
            'value' => 10,
            'is_active' => true,
        ]);

        $coupon = app(CouponService::class)->resolve('HEMAT10', 100_000);

        $this->assertSame('HEMAT10', $coupon->code);
    }

    public function test_resolve_rejects_expired_coupon(): void
    {
        Coupon::create([
            'code' => 'EXPIRED',
            'type' => 'percent',
            'value' => 10,
            'valid_from' => now()->subDays(10),
            'valid_until' => now()->subDay(),
            'is_active' => true,
        ]);

        $this->expectException(ValidationException::class);

        app(CouponService::class)->resolve('EXPIRED', 100_000);
    }

    public function test_resolve_rejects_minimum_order_not_met(): void
    {
        Coupon::create([
            'code' => 'MINIMUM',
            'type' => 'percent',
            'value' => 10,
            'min_order_amount' => 500_000,
            'is_active' => true,
        ]);

        $this->expectException(ValidationException::class);

        app(CouponService::class)->resolve('MINIMUM', 100_000);
    }

    public function test_resolve_rejects_usage_limit_reached(): void
    {
        Coupon::create([
            'code' => 'LIMIT',
            'type' => 'percent',
            'value' => 10,
            'usage_limit' => 1,
            'used_count' => 1,
            'is_active' => true,
        ]);

        $this->expectException(ValidationException::class);

        app(CouponService::class)->resolve('LIMIT', 100_000);
    }

    public function test_discount_percent_is_capped_by_max_discount(): void
    {
        $coupon = Coupon::create([
            'code' => 'CAP',
            'type' => 'percent',
            'value' => 50,
            'max_discount_amount' => 20_000,
            'is_active' => true,
        ]);

        $discount = app(CouponService::class)->discount($coupon, 100_000);

        $this->assertSame(20_000.0, $discount);
    }

    public function test_discount_nominal(): void
    {
        $coupon = Coupon::create([
            'code' => 'NOMINAL',
            'type' => 'nominal',
            'value' => 25_000,
            'is_active' => true,
        ]);

        $discount = app(CouponService::class)->discount($coupon, 100_000);

        $this->assertSame(25_000.0, $discount);
    }

    public function test_increment_usage_throws_when_limit_reached(): void
    {
        Coupon::create([
            'code' => 'FULL',
            'type' => 'nominal',
            'value' => 10_000,
            'usage_limit' => 2,
            'used_count' => 2,
            'is_active' => true,
        ]);

        $this->expectException(\RuntimeException::class);

        app(CouponService::class)->incrementUsage('FULL');
    }

    public function test_increment_usage_increases_counter(): void
    {
        Coupon::create([
            'code' => 'COUNT',
            'type' => 'nominal',
            'value' => 10_000,
            'usage_limit' => 5,
            'used_count' => 0,
            'is_active' => true,
        ]);

        app(CouponService::class)->incrementUsage('COUNT');

        $this->assertDatabaseHas('coupons', ['code' => 'COUNT', 'used_count' => 1]);
    }
}
