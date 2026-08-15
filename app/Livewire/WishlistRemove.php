<?php

namespace App\Livewire;

use App\Data\ProductData;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistRemove extends Component
{
    public string $sku;

    public function mount(ProductData|Product $product)
    {
        if ($product instanceof Product) {
            $product = ProductData::from($product);
        }

        $this->sku = $product->sku;
    }

    public function remove()
    {
        $product = Product::where('sku', $this->sku)->firstOrFail();

        Auth::user()->wishlistProducts()->detach($product);

        toast('Produk dihapus dari wishlist.', 'info');

        $this->dispatch('wishlist-count-updated');

        return redirect()->route('account.wishlist');
    }

    public function render()
    {
        return view('livewire.wishlist-remove');
    }
}
