<?php

namespace App\Livewire;

use App\Contract\CartServiceInterface;
use Livewire\Component;
use App\Data\ProductData;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class CartRemove extends Component
{
    use WithSweetAlert;
    public string $sku;

    public function mount(ProductData $product)
    {
        $this->sku = $product->sku;
    }
    public function remove(CartServiceInterface $cart)
    {
        $cart->remove($this->sku);

        session()->flash('success', "Product, {$this->sku} a removed");

        // $this->swalFire([
        //         'title' => 'Saved successfully!',
        //         'text' => "The Product, {$this->sku} Removed!",
        //         'icon' => 'success',
        //     ]);

        $this->dispatch('cart_updated');
        return redirect()->route('cart');
    }

    public function render()
    {
        return view('livewire.cart-remove');
    }
}
