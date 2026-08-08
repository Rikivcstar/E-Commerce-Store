<?php
declare(strict_types=1);

namespace App\Data;

use App\Models\Category;
use Spatie\LaravelData\Data;

class CategoryData extends Data
{
    public function __construct(
        //
        public int $id,
        public string $name,
        public string $slug,
        public int|null $parent_id,
        public int $product_count,
        public array $children,
    ) {}

    public static function fromModel(Category $category): self
    {
        return new self(
            $category->id,
            (string) $category->name,
            (string) $category->slug,
            $category->parent_id,
            $category->products_count,
            $category->children
                ->sortBy('order_column')
                ->map(fn (Category $child) => self::fromModel($child))
                ->values()
                ->toArray()
        );
    }
}