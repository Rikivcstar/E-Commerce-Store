<?php

namespace App\Livewire;

use App\Contract\CartServiceInterface;
use App\Data\CartItemData;
use App\Data\ProductData;
use Livewire\Component;

class AddToCard extends Component
{
    public int $quantity;
    public string $sku;
    public int $stock;
    public float $price;
    public int $weight;
    public string $label = 'add to cart';

    public function mount(ProductData $product, CartServiceInterface $cart, string $label = 'add to cart')
    {
        $this->sku = $product->sku;
        $this->stock = $product->stock;
        $this->price = $product->price;
        $this->weight = $product->weight;
        $this->label = $label;
        $this->quantity = $cart->getItemBySku($product->sku)->quantity ?? 1;
    }

    public function addCard(CartServiceInterface $cart)
    {
        $this->validate();
        $cart->addOrUpdated(new CartItemData(
            sku: $this->sku,
            quantity: $this->quantity,
            price: $this->price,
            weight: $this->weight
        ));

        toast('Produk berhasil ditambahkan ke keranjang!', 'success');

        $this->dispatch('cartUpdated');

        return redirect()->route('cart');
    }

    protected function rules(): array
    {
        return [
            'quantity' => ['min:1', "max:{$this->stock}", 'required', 'integer']
        ];
    }

    public function render()
    {
        return view('livewire.add-to-card');
    }
}
