<?php

namespace App\Livewire;

use App\Data\ProductData;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Services\RecommendationService;
use Illuminate\Support\Facades\Auth;
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

        $recommendation_service = app(RecommendationService::class);

        $feature_products = ProductData::collect($recommendation_service->popular(8));
        $latest_products = ProductData::collect(
            Product::query()->latest()->limit(4)->get()
        );
        $popular_products = ProductData::collect($recommendation_service->popular(4, days: 30));
        $personalized_products = ProductData::collect(
            Auth::check()
                ? $recommendation_service->personalized(Auth::user(), 4)
                : collect()
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

        return view('livewire.home-page', compact(
            'banners',
            'feature_products',
            'latest_products',
            'popular_products',
            'personalized_products',
            'categories',
            'static_pages'
        ));
    }
}
