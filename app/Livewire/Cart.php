<?php

namespace App\Livewire;

use Livewire\Component;
use App\Data\ProductData;
use App\Models\Product;
use Illuminate\Support\Collection;
use App\Contract\CartServiceInterface;

class Cart extends Component
{
    public string $subTotal;

    public string $total;

    public function mount(CartServiceInterface $cart)
    {
        $all = $cart->all();

        $this->subTotal = $all->total_formatted;
        $this->total = $this->subTotal;
    }

    public function getItemsProperty(CartServiceInterface $cart): Collection
    {
        return $cart->all()->items->toCollection();
    }

    public function checkout()
    {
        return redirect()->route('checkout');

    }

    public function render()
    {
        $cartSkus = $this->items->pluck('sku')->all();

        $recommendations = ProductData::collect(
            Product::query()
                ->when($cartSkus !== [], fn ($query) => $query->whereNotIn('sku', $cartSkus))
                ->inRandomOrder()
                ->limit(4)
                ->get()
        );

        return view('livewire.cart', [
            'items' => $this->items,
            'recommendations' => $recommendations,
        ]);
    }
}
