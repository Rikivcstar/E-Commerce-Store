<?php

namespace App\Livewire;

use App\Contract\CartServiceInterface;
use App\Data\CartItemData;
use App\Data\ProductData;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Wishlist extends Component
{
    public function mount()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }
    }

    public function getItemsProperty(): Collection
    {
        return Auth::user()
            ->wishlistProducts()
            ->latest('products.created_at')
            ->get()
            ->map(fn ($product) => ProductData::fromModel($product));
    }

    public function addToCart(string $sku): void
    {
        $product = Product::where('sku', $sku)->first();

        if (! $product) {
            toast('Produk tidak ditemukan.', 'error');

            return;
        }

        if ($product->stock < 1) {
            toast('Stok produk sedang habis.', 'error');

            return;
        }

        app(CartServiceInterface::class)->addOrUpdated(new CartItemData(
            sku: $product->sku,
            quantity: 1,
            price: (float) $product->price,
            weight: (int) $product->weight,
        ));

        $this->dispatch('cartUpdated');

        toast("{$product->name} ditambahkan ke keranjang!", 'success');
    }

    public function render()
    {
        return view('livewire.wishlist', [
            'items' => $this->items,
        ])->layout('components.layouts.app');
    }
}