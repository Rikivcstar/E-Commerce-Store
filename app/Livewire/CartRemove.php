<?php

namespace App\Livewire;

use App\Contract\CartServiceInterface;
use App\Data\ProductData;
use App\Models\Product;
use Livewire\Component;

class CartRemove extends Component
{
    public string $sku;

    public function mount(ProductData|Product $product)
    {
        if ($product instanceof Product) {
            $product = ProductData::from($product);
        }

        $this->sku = $product->sku;
    }

    public function remove(CartServiceInterface $cart)
    {
        $cart->remove($this->sku);

        toast('Produk berhasil dihapus dari keranjang.', 'info');

        $this->dispatch('cartUpdated');

        return redirect()->route('cart');
    }

    public function render()
    {
        return view('livewire.cart-remove');
    }
}
