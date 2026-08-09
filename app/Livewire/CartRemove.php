<?php

namespace App\Livewire;

use App\Contract\CartServiceInterface;
use Livewire\Component;
use App\Data\ProductData;

class CartRemove extends Component
{
    public string $sku;

    public function mount(ProductData $product)
    {
        $this->sku = $product->sku;
    }

    public function remove(CartServiceInterface $cart)
    {
        $cart->remove($this->sku);

        toast('Produk berhasil dihapus dari keranjang.', 'info');

        $this->dispatch('cart_updated');

        return redirect()->route('cart');
    }

    public function render()
    {
        return view('livewire.cart-remove');
    }
}
