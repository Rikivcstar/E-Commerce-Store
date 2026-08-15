<?php

namespace App\Data;

use Illuminate\Support\Number;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class CouponData extends Data
{
    #[Computed]
    public string $discount_total_formatted;

    public function __construct(
        public string $code,
        public string $type,
        public float $value,
        public float $discount_total,
    ) {
        $this->discount_total_formatted = Number::currency($discount_total);
    }
}
