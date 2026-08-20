<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Models\SalesOrderItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class RecommendationService
{
    /**
     * Produk terlaris berdasarkan total quantity terjual (top seller).
     *
     * @param  array<int, string>  $exceptSkus
     */
    public function popular(int $limit = 8, array $exceptSkus = [], ?int $days = null): Collection
    {
        return Product::query()
            ->orderByDesc(
                SalesOrderItem::query()
                    ->when($days, fn (Builder $query) => $query->where('created_at', '>=', now()->subDays($days)))
                    ->whereColumn('sales_order_items.sku', 'products.sku')
                    ->selectRaw('COALESCE(SUM(quantity), 0)')
            )
            ->when($exceptSkus !== [], fn (Builder $query) => $query->whereNotIn('sku', $exceptSkus))
            ->limit($limit)
            ->get();
    }

    /**
     * Produk yang sering dibeli bersamaan dengan sku tertentu,
     * diurutkan berdasarkan frekuensi co-occurrence dalam satu order.
     *
     * @return Collection<int, Product>
     */
    public function frequentlyBoughtTogether(string $sku, int $limit = 4): Collection
    {
        $related_order_ids = SalesOrderItem::query()
            ->where('sku', $sku)
            ->distinct()
            ->pluck('sales_order_id');

        if ($related_order_ids->isEmpty()) {
            return collect();
        }

        return Product::query()
            ->where('sku', '!=', $sku)
            ->whereHas('salesOrderItems', function (Builder $query) use ($related_order_ids) {
                $query->whereIn('sales_order_id', $related_order_ids);
            })
            ->withCount(['salesOrderItems as cooccurrence_count' => function (Builder $query) use ($related_order_ids) {
                $query->whereIn('sales_order_id', $related_order_ids);
            }])
            ->orderByDesc('cooccurrence_count')
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Rekomendasi personal berbasis riwayat belanja user.
     * Mencari produk yang sering dibeli bersamaan dengan produk yang pernah
     * dibeli user (item-based collaborative filtering), lalu mengecualikan
     * produk yang sudah pernah dibeli user.
     *
     * @return Collection<int, Product>
     */
    public function personalized(?User $user, int $limit = 4): Collection
    {
        if (! $user) {
            return collect();
        }

        $purchasedSkus = SalesOrderItem::query()
            ->whereHas('salesOrder', fn (Builder $query) => $query->where('user_id', $user->id))
            ->distinct()
            ->pluck('sku')
            ->all();

        if ($purchasedSkus === []) {
            return collect();
        }

        $topSkus = SalesOrderItem::query()
            ->whereHas('salesOrder', fn (Builder $query) => $query->where('user_id', $user->id))
            ->selectRaw('sku, SUM(quantity) as total_qty')
            ->groupBy('sku')
            ->orderByDesc('total_qty')
            ->limit(3)
            ->pluck('sku')
            ->all();

        $candidates = collect();

        foreach ($topSkus as $sku) {
            $candidates = $candidates->merge($this->frequentlyBoughtTogether($sku, 6));
        }

        return $candidates
            ->reject(fn (Product $product) => in_array($product->sku, $purchasedSkus, true))
            ->unique('id')
            ->take($limit)
            ->values();
    }
}