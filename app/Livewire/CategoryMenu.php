<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryMenu extends Component
{
    public function render()
    {
        $categories = \Illuminate\Support\Facades\Cache::remember('menu_categories', now()->addHour(), function () {
            return Category::query()
                ->active()
                ->whereNull('parent_id')
                ->with(['children' => fn ($query) => $query->active()->orderBy('order_column')])
                ->withCount('products')
                ->orderBy('order_column')
                ->get();
        });

        return view('livewire.category-menu', compact('categories'));
    }
}
