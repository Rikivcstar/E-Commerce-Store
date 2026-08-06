<?php

namespace App\Http\Controllers;

use App\Data\ProductData;
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

        $product = ProductData::fromModel($product, true);

        return view('product.show', compact('product', 'recommendations'));
    }
}