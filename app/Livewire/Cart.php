<?php

namespace App\Livewire;

use App\Contract\CartServiceInterface;
use App\Data\ProductData;
use App\Services\RecommendationService;
use Illuminate\Support\Collection;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class Cart extends Component
{
    public string $subTotal;

    public string $total;

    public function placeholder()
    {
        return view('livewire.cart-skeleton');
    }

    public function mount()
    {
        $cart = app(CartServiceInterface::class);

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
            app(RecommendationService::class)->popular(limit: 4, exceptSkus: $cartSkus)
        );

        return view('livewire.cart', [
            'items' => $this->items,
            'recommendations' => $recommendations,
        ]);
    }
}
