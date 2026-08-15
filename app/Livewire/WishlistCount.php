<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class WishlistCount extends Component
{
    public int $count = 0;

    public function mount(): void
    {
        $this->refreshCount();
    }

    #[On('wishlist-count-updated')]
    public function refreshCount(): void
    {
        $this->count = Auth::check() ? Auth::user()->wishlistProducts()->count() : 0;
    }

    public function render()
    {
        return view('livewire.wishlist-count');
    }
}
