<?php

namespace App\Livewire;

use App\Data\ProductData;
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

    public function render()
    {
        return view('livewire.wishlist', [
            'items' => $this->items,
        ])->layout('components.layouts.app');
    }
}