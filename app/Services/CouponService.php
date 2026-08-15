<?php

namespace App\Services;

use App\Data\CouponData;
use App\Models\Coupon;
use Illuminate\Validation\ValidationException;

class CouponService
{
    public function resolve(string $code, float $sub_total): Coupon
    {
        $coupon = Coupon::query()->running()->where('code', $code)->first();

        if (! $coupon) {
            throw ValidationException::withMessages([
                'coupon_code' => 'Kode promo tidak valid atau sudah kedaluwarsa.',
            ]);
        }

        if (! $coupon->isValid($sub_total)) {
            throw ValidationException::withMessages([
                'coupon_code' => $this->invalidReason($coupon, $sub_total),
            ]);
        }

        return $coupon;
    }

    public function discount(Coupon $coupon, float $sub_total): float
    {
        return $coupon->discountFor($sub_total);
    }

    public function apply(string $code, float $sub_total): CouponData
    {
        $coupon = $this->resolve($code, $sub_total);

        return new CouponData(
            code: $coupon->code,
            type: $coupon->type,
            value: $coupon->value,
            discount_total: $this->discount($coupon, $sub_total),
        );
    }

    public function incrementUsage(string $code): void
    {
        // Kunci baris kupon di dalam transaksi order agar pemakaian bersamaan
        // tidak melampaui usage_limit.
        $coupon = Coupon::query()->where('code', $code)->lockForUpdate()->first();

        if (! $coupon) {
            return;
        }

        if ($coupon->usage_limit !== null && $coupon->used_count >= $coupon->usage_limit) {
            throw new \RuntimeException('Kode promo sudah mencapai batas pemakaian.');
        }

        $coupon->increment('used_count');
    }

    protected function invalidReason(Coupon $coupon, float $sub_total): string
    {
        if ($coupon->usage_limit !== null && $coupon->used_count >= $coupon->usage_limit) {
            return 'Kode promo sudah mencapai batas pemakaian.';
        }

        if ($coupon->min_order_amount > 0 && $sub_total < $coupon->min_order_amount) {
            return 'Kode promo berlaku untuk minimal belanja '.number_format($coupon->min_order_amount, 0, ',', '.');
        }

        if (! $coupon->is_active) {
            return 'Kode promo sedang nonaktif.';
        }

        return 'Kode promo tidak berlaku pada waktu ini.';
    }
}
