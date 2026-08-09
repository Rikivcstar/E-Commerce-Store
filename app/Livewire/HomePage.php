<?php

namespace App\Livewire;

use App\Data\ProductData;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        $feature_products = ProductData::collect(
            Product::query()->inRandomOrder()->limit(8)->get()
        );
        $latest_products = ProductData::collect(
            Product::query()->latest()->limit(4)->get()
        );
        $popular_products = ProductData::collect(
            Product::query()->inRandomOrder()->limit(4)->get()
        );
        $categories = Category::query()
            ->active()
            ->whereNull('parent_id')
            ->with(['children' => fn ($query) => $query->active()])
            ->withCount('products')
            ->orderBy('order_column')
            ->limit(6)
            ->get();

        $static_pages = Page::query()
            ->active()
            ->latest()
            ->take(6)
            ->get();

        return view('livewire.home-page', compact('feature_products', 'latest_products', 'popular_products', 'categories', 'static_pages'));
    }
}
