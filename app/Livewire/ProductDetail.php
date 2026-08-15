<?php

namespace App\Livewire;

use App\Data\ProductData;
use App\Models\Category;
use App\Models\Product;
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
        $recommendations = ProductData::collect(
            Product::query()
                ->whereKeyNot($this->product->getKey())
                ->inRandomOrder()
                ->limit(4)
                ->get()
        );

        $breadcrumbs = $this->categoryTrail($this->product->categories->first());

        $productData = ProductData::fromModel($this->product, true);

        return view('livewire.product-detail', [
            'productData' => $productData,
            'product' => $this->product,
            'recommendations' => $recommendations,
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
