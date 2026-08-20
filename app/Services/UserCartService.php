<?php

declare(strict_types=1);

namespace App\Services;

use App\Contract\CartServiceInterface;
use App\Data\CartData;
use App\Data\CartItemData;
use App\Models\Product;
use App\Models\UserCartItem;
use Illuminate\Support\Collection;
use Spatie\LaravelData\DataCollection;

/**
 * Keranjang belanja berbasis database untuk user yang telah login.
 * Memungkinkan sinkronisasi antar perangkat dan penggabungan (merge)
 * dengan cart guest saat login.
 */
class UserCartService implements CartServiceInterface
{
    public function addOrUpdated(CartItemData $item): void
    {
        UserCartItem::query()->updateOrCreate(
            ['user_id' => auth()->id(), 'sku' => $item->sku],
            ['quantity' => $item->quantity]
        );
    }

    public function remove(string $sku): void
    {
        UserCartItem::query()
            ->where('user_id', auth()->id())
            ->where('sku', $sku)
            ->delete();
    }

    public function clear(): void
    {
        UserCartItem::query()
            ->where('user_id', auth()->id())
            ->delete();
    }

    public function getItemBySku(string $sku): ?CartItemData
    {
        $row = UserCartItem::query()
            ->where('user_id', auth()->id())
            ->where('sku', $sku)
            ->first();

        return $row ? $this->toCartItem($row) : null;
    }

    public function all(): CartData
    {
        $items = UserCartItem::query()
            ->where('user_id', auth()->id())
            ->get()
            ->map(fn (UserCartItem $row) => $this->toCartItem($row))
            ->filter()
            ->values();

        return new CartData(new DataCollection(CartItemData::class, $items->values()->all()));
    }

    /**
     * Menggabungkan item cart guest (sesi) ke keranjang user di database.
     * Kuantitas dijumlahkan dengan item yang sudah ada, dibatasi stok produk.
     *
     * @param  Collection<int, CartItemData>  $items
     */
    public function mergeItemsForUser(Collection $items, int $userId): int
    {
        $merged = 0;

        foreach ($items as $item) {
            $product = Product::where('sku', $item->sku)->first();

            if (! $product) {
                continue;
            }

            $existing = UserCartItem::query()
                ->where('user_id', $userId)
                ->where('sku', $item->sku)
                ->first();

            $quantity = $existing
                ? $existing->quantity + $item->quantity
                : $item->quantity;

            if ($product->stock > 0) {
                $quantity = min($quantity, $product->stock);
            }

            UserCartItem::query()->updateOrCreate(
                ['user_id' => $userId, 'sku' => $item->sku],
                ['quantity' => max(1, $quantity)]
            );

            $merged++;
        }

        return $merged;
    }

    /**
     * Menggabungkan item cart guest (sesi) ke keranjang user di database,
     * lalu mengosongkan cart sesi bila ada item yang berhasil digabung.
     *
     * @return int jumlah SKU yang berhasil digabung
     */
    public function mergeFromSession(int $userId): int
    {
        $sessionItems = app(SessionCartService::class)->all()->items->toCollection();

        if ($sessionItems->isEmpty()) {
            return 0;
        }

        $merged = $this->mergeItemsForUser($sessionItems, $userId);

        if ($merged > 0) {
            app(SessionCartService::class)->clear();
        }

        return $merged;
    }

    protected function toCartItem(UserCartItem $row): ?CartItemData
    {
        $product = Product::where('sku', $row->sku)->first();

        if (! $product) {
            return null;
        }

        return new CartItemData(
            sku: $row->sku,
            quantity: $row->quantity,
            price: (float) $product->price,
            weight: $product->weight,
        );
    }
}