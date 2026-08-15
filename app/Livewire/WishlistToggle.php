<?php

namespace App\Livewire;

use App\Data\ProductData;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistToggle extends Component
{
    public string $sku;

    public bool $isInWishlist = false;

    public string $variant = 'button';

    public function mount(ProductData|Product $product, string $variant = 'button')
    {
        if ($product instanceof Product) {
            $product = ProductData::fromModel($product);
        }

        $this->sku = $product->sku;
        $this->variant = $variant;
        $this->isInWishlist = $this->hasInWishlist();
    }

    public function toggle()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $product = Product::where('sku', $this->sku)->firstOrFail();
        $user = Auth::user();

        if ($user->wishlistProducts()->whereKey($product->getKey())->exists()) {
            $user->wishlistProducts()->detach($product);
            toast('Produk dihapus dari wishlist.', 'info');
        } else {
            $user->wishlistProducts()->attach($product);
            toast('Produk ditambahkan ke wishlist!', 'success');
        }

        $this->isInWishlist = ! $this->isInWishlist;

        $this->dispatch('wishlist-count-updated');
    }

    protected function hasInWishlist(): bool
    {
        $user = Auth::user();

        if (! $user) {
            return false;
        }

        return $user->wishlistProducts()
            ->where('products.sku', $this->sku)
            ->exists();
    }

    public function render()
    {
        return view('livewire.wishlist-toggle');
    }
}
