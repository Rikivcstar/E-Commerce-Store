<?php

declare(strict_types=1);

namespace App\Data;

use App\Models\Product;
use Illuminate\Support\Number;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ProductData extends Data
{
    #[Computed]
    public string $price_formatted;

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
        public int $sold_count = 0
    ) {
        $this->price_formatted = Number::currency($price);
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
            sold_count: $soldCount
        );
    }
}
