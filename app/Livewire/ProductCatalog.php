<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Data\CategoryData;
use App\Data\ProductCollectionData;
use App\Data\ProductData;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy]
class ProductCatalog extends Component
{
    use WithPagination;

    public $queryString = [
        'selectCollection' => ['except' => []],
        'selectCategory' => ['except' => []],
        'search' => ['except' => ''],
        'shortBy' => ['except' => 'newest'],
    ];

    public function placeholder()
    {
        return view('livewire.product-catalog-skeleton');
    }

    public array $selectCollection = [];

    public array $selectCategory = [];

    public string $search = '';

    public string $shortBy = 'newest';

    public function resetFilter()
    {

        $this->selectCollection = [];
        $this->selectCategory = [];
        $this->search = '';
        $this->shortBy = 'newest';
        $this->resetErrorBag();
        $this->resetPage();
    }

    public function mount()
    {
        $this->validate();
    }

    protected function rules()
    {
        return [
            'selectCollection' => 'array',
            'selectCollection.*' => 'integer|exists:tags,id',
            'selectCategory' => 'array',
            'selectCategory.*' => 'integer|exists:categories,id',
            'search' => 'nullable|min:3|max:30',
            'shortBy' => 'in:newest,latest,price_asc,price_desc,popular',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'selectCollection' => __('Collection'),
            'selectCategory' => __('Category'),
        ];
    }

    public function applySearch()
    {
        $this->validate();
        $this->resetPage();
    }

    public function applySort(string $sort)
    {
        $this->shortBy = in_array($sort, ['newest', 'latest', 'price_asc', 'price_desc', 'popular'], true) ? $sort : 'newest';
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $collections = ProductCollectionData::collect([]);
        $categories = CategoryData::collect([]);
        $products = ProductCollectionData::collect([]);

        if ($this->getErrorBag()->isNotEmpty()) {
            return view('livewire.product-catalog', compact('products', 'collections', 'categories'));
        }

        $collection_result = Tag::query()->withType('collection')->withCount('products')->get();
        // $result = Product::paginate(9);
        $query = Product::query();

        if ($this->search) {

            $query->where('name', 'LIKE', "%{$this->search}%");
        }

        if (! empty($this->selectCategory)) {
            $query->whereHas('categories', function ($query) {
                $query->whereIn('id', $this->selectCategory);
            });
        }

        if (! empty($this->selectCollection)) {
            $query->whereHas('tags', function ($query) {
                $query->whereIn('id', $this->selectCollection);
            });
        }

        switch ($this->shortBy) {
            case 'latest':
                $query->latest();
                break;
            case 'popular':
                $query->orderByDesc(
                    \App\Models\SalesOrderItem::query()
                        ->whereColumn('sales_order_items.sku', 'products.sku')
                        ->selectRaw('COALESCE(SUM(quantity), 0)')
                );
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $products = ProductData::collect(
            $query->paginate(12)
        );
        $collections = ProductCollectionData::collect($collection_result);
        $categories = CategoryData::collect(
            Category::query()
                ->whereNull('parent_id')
                ->with(['children' => fn ($query) => $query->withCount('products')])
                ->withCount('products')
                ->orderBy('order_column')
                ->get()
        );

        return view('livewire.product-catalog', compact('products', 'collections', 'categories'));
    }
}
