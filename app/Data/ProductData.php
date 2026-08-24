<?php

declare(strict_types=1);

namespace App\Data;

use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ProductData extends Data
{
    #[Computed]
    public string $price_formatted;

    #[Computed]
    public bool $is_on_sale;

    #[Computed]
    public float $effective_price;

    #[Computed]
    public string $effective_price_formatted;

    #[Computed]
    public ?string $original_price_formatted;

    #[Computed]
    public int $discount_percent;

    public function __construct(
        //
        public string $name,
        public string $short_desc,
        public string $sku,
        public string $slug,
        public string|null|Optional $description,
        public int $stock,
        public float $price,
        public int $weight,
        public string $cover_url,
        public Optional|array $gallery = new Optional,
        public string $collection = 'Curated Goods',
        public int $sold_count = 0,
        public Optional|float|null $sale_price = new Optional,
        public Optional|string|null $sale_starts_at = new Optional,
        public Optional|string|null $sale_ends_at = new Optional
    ) {
        $this->price_formatted = Number::currency($price);

        $resolvedSalePrice = $sale_price instanceof Optional ? null : $sale_price;
        $resolvedStartsAt = $sale_starts_at instanceof Optional ? null : $sale_starts_at;
        $resolvedEndsAt = $sale_ends_at instanceof Optional ? null : $sale_ends_at;

        $this->is_on_sale = self::resolveIsOnSale($resolvedSalePrice, $resolvedStartsAt, $resolvedEndsAt);
        $this->effective_price = $this->is_on_sale ? (float) $resolvedSalePrice : $price;
        $this->effective_price_formatted = Number::currency($this->effective_price);
        $this->original_price_formatted = $this->is_on_sale ? $this->price_formatted : null;
        $this->discount_percent = $this->is_on_sale && $price > 0
            ? (int) round((1 - ((float) $resolvedSalePrice / $price)) * 100)
            : 0;
    }

    private static function resolveIsOnSale(?float $salePrice, ?string $startsAt, ?string $endsAt): bool
    {
        if ($salePrice === null || $salePrice <= 0) {
            return false;
        }

        $started = $startsAt === null || Carbon::parse($startsAt)->lessThanOrEqualTo(now());
        $notEnded = $endsAt === null || Carbon::parse($endsAt)->greaterThanOrEqualTo(now());

        return $started && $notEnded;
    }

    public static function fromModel(Product $product, bool $with_gallery = false): self
    {
        $coverUrl = $product->cover_url;

        $gallery = $with_gallery
            ? $product->getMedia('gallery')->map(fn ($record) => $record->getUrl())->toArray()
            : new Optional;

        if (is_array($gallery) && empty($gallery)) {
            $gallery = [$coverUrl];
        }

        $collection = $product->collection_name ?? 'Curated Goods';
        $soldCount = $product->sold_count ?? 0;

        return new self(
            $product->name,
            $product->short_desc ?? '',
            $product->sku,
            $product->slug,
            $product->description,
            $product->stock,
            floatval($product->price),
            $product->weight,
            $coverUrl,
            gallery: $gallery,
            collection: $collection,
            sold_count: $soldCount,
            sale_price: $product->sale_price !== null ? (float) $product->sale_price : null,
            sale_starts_at: $product->sale_starts_at?->toISOString(),
            sale_ends_at: $product->sale_ends_at?->toISOString(),
        );
    }
}