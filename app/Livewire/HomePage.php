<?php

namespace App\Livewire;

use App\Data\ProductData;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class HomePage extends Component
{
    public function placeholder()
    {
        return view('livewire.home-page-skeleton');
    }

    public function render()
    {
        $banners = Cache::remember('home_banners', now()->addHour(), function () {
            return Banner::query()
                ->active()
                ->orderBy('order_column')
                ->orderByDesc('id')
                ->get();
        });

        $feature_products = ProductData::collect(
            Product::query()->inRandomOrder()->limit(8)->get()
        );
        $latest_products = ProductData::collect(
            Product::query()->latest()->limit(4)->get()
        );
        $popular_products = ProductData::collect(
            Product::query()->inRandomOrder()->limit(4)->get()
        );

        $categories = Cache::remember('home_categories', now()->addHour(), function () {
            return Category::query()
                ->active()
                ->whereNull('parent_id')
                ->with(['children' => fn ($query) => $query->active()])
                ->withCount('products')
                ->orderBy('order_column')
                ->limit(6)
                ->get();
        });

        $static_pages = Cache::remember('home_static_pages', now()->addHour(), function () {
            return Page::query()
                ->active()
                ->latest()
                ->take(6)
                ->get();
        });

        return view('livewire.home-page', compact('banners', 'feature_products', 'latest_products', 'popular_products', 'categories', 'static_pages'));
    }
}
