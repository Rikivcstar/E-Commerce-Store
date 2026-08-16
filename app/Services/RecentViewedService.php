<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class RecentViewedService
{
    protected string $session_key = 'recently_viewed';

    protected int $limit = 6;

    public function add(string $sku): void
    {
        $skus = collect(Session::get($this->session_key, []))
            ->reject(fn (string $item) => $item === $sku)
            ->prepend($sku)
            ->take($this->limit)
            ->values()
            ->all();

        Session::put($this->session_key, $skus);
    }

    public function skus(): array
    {
        return (array) Session::get($this->session_key, []);
    }

    /**
     * Produk yang pernah dilihat user, terurut dari yang paling baru.
     *
     * @param  array<int, string>  $exceptSkus
     * @return Collection<int, Product>
     */
    public function products(array $exceptSkus = []): Collection
    {
        $skus = collect($this->skus())
            ->reject(fn (string $sku) => in_array($sku, $exceptSkus, true))
            ->take($this->limit);

        if ($skus->isEmpty()) {
            return collect();
        }

        return Product::query()
            ->whereIn('sku', $skus->all())
            ->get()
            ->sortBy(fn (Product $product) => $skus->search($product->sku))
            ->values();
    }
}