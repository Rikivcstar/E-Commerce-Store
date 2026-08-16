<?php

namespace App\Livewire;

use App\Data\ProductData;
use App\Models\Category;
use App\Models\Product;
use App\Services\RecentViewedService;
use App\Services\RecommendationService;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class ProductDetail extends Component
{
    public Product $product;

    public function placeholder()
    {
        return view('livewire.product-detail-skeleton');
    }

    public function render()
    {
        $recent_viewed_service = app(RecentViewedService::class);
        $recent_viewed_service->add($this->product->sku);

        $recommendation_service = app(RecommendationService::class);

        $recommendations = ProductData::collect(
            $recommendation_service->frequentlyBoughtTogether($this->product->sku, 4)
        );

        if ($recommendations->isEmpty()) {
            $recommendations = ProductData::collect(
                $recommendation_service->popular(4, [$this->product->sku])
            );
        }

        $recently_viewed = ProductData::collect(
            $recent_viewed_service->products([$this->product->sku])
        );

        $breadcrumbs = $this->categoryTrail($this->product->categories->first());

        $productData = ProductData::fromModel($this->product, true);

        return view('livewire.product-detail', [
            'productData' => $productData,
            'product' => $this->product,
            'recommendations' => $recommendations,
            'recently_viewed' => $recently_viewed,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    private function categoryTrail(?Category $category): array
    {
        $trail = [];

        if ($category) {
            $category->loadMissing('parent');

            while ($category) {
                $trail[] = $category;
                $category = $category->parent;
            }
        }

        return array_reverse($trail);
    }
}
