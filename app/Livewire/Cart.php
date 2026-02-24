<?php

namespace App\Livewire;

use App\Actions\ValidateCartStock;
use Livewire\Component;
use Illuminate\Support\Collection;
use App\Contract\CartServiceInterface;
use Illuminate\Validation\ValidationException;

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
        return view('livewire.cart',[
                    'items' => $this->items
                    ]);
    }
}
