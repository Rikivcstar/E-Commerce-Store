<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Data\ProductCollectionData;
use App\Models\Tag;
use App\Models\Product;
use Livewire\Component;
use App\Data\ProductData;
use App\Filament\Resources\Products\Tables\ProductsTable;
use League\Uri\QueryString;
use Livewire\WithPagination;

class ProductCatalog extends Component
{
    use WithPagination;

    public $queryString = [
        'selectCollection' => ['except' => []],
        'search' => ['except' => 'newest'],
        'shortBy' => ['except' => '']
    ];
    public array $selectCollection =[];

    public string $search = '';

    public string $shortBy = 'newest';

    public function resetFilter(){

        $this->selectCollection = [];
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
            'search' => 'nullable|min:3|max:30',
            'shortBy' => 'in:newest,latest,price_asc,price_desc'
        ];
    }

    public function applySeacrh()
    {
         $this->validate();
         $this->resetPage();
    }


    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $collections = ProductCollectionData::collect([]);
        $products = ProductCollectionData::collect([]);

        if($this->getErrorBag()->isNotEmpty())
        {
             return view('livewire.product-catalog', compact('products', 'collections'));
        }

        $collection_result = Tag::query()->withType('collection')->withCount('products')->get();
        // $result = Product::paginate(9);
        $query = Product::query();

        if($this->search){

            $query->where('name', 'LIKE', "%{$this->search}%");
        }

        if(!empty($this->selectCollection)){
            $query->whereHas('tags', function($query) {
                $query->whereIn('id', $this->selectCollection);
            });
        }

        switch($this->shortBy){
            case 'latest';
                 $query->oldest();
                 break;
            case 'price_asc';
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc';
                $query->orderBy('price', 'desc');
                break;
            default;
                $query->latest();
                break;
        }

        $products = ProductData::collect(
            $query->paginate(9)
        );
        $collections = ProductCollectionData::collect($collection_result);

        // TODO make TDO
        return view('livewire.product-catalog', compact('products', 'collections'));
    }
}
