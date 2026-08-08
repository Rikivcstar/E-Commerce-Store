<?php

namespace App\Http\Controllers;

use App\Data\ProductData;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $recommendations = ProductData::collect(
            Product::query()
                ->whereKeyNot($product->getKey())
                ->inRandomOrder()
                ->limit(4)
                ->get()
        );

        $breadcrumbs = $this->categoryTrail($product->categories->first());

        $product = ProductData::fromModel($product, true);

        return view('product.show', compact('product', 'recommendations', 'breadcrumbs'));
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