<?php

namespace App\Livewire;

use App\Data\ProductData;
use App\Models\Product;
use Livewire\Component;

class GlobalSearch extends Component
{
    public string $query = '';

    public function render()
    {
        $queryText = trim($this->query);

        if (strlen($queryText) >= 2) {
            $matchingProducts = Product::query()
                ->where('name', 'like', '%'.$queryText.'%')
                ->orWhere('description', 'like', '%'.$queryText.'%')
                ->latest()
                ->take(6)
                ->get();
        } else {
            $matchingProducts = Product::query()
                ->latest()
                ->take(6)
                ->get();
        }

        $results = ProductData::collect($matchingProducts);

        return view('livewire.global-search', compact('results'));
    }
}
