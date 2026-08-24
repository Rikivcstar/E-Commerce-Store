<?php

namespace App\Livewire;

use App\Data\ProductData;
use App\Models\Product;
use App\Models\ProductQuestion;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductQuestions extends Component
{
    public string $sku;

    public array $form = [
        'name' => '',
        'email' => '',
        'question' => '',
    ];

    public function mount(ProductData|Product $product): void
    {
        if ($product instanceof Product) {
            $product = ProductData::from($product);
        }

        $this->sku = $product->sku;

        $user = Auth::user();

        if ($user) {
            $this->form['name'] = $user->name;
            $this->form['email'] = $user->email;
        }
    }

    public function rules(): array
    {
        $guestRules = Auth::check() ? [] : [
            'form.name' => ['required', 'string', 'min:2', 'max:120'],
            'form.email' => ['required', 'email', 'max:255'],
        ];

        return array_merge($guestRules, [
            'form.question' => ['required', 'string', 'min:5', 'max:1000'],
        ]);
    }

    protected function validationAttributes(): array
    {
        return [
            'form.name' => 'Nama',
            'form.email' => 'Email',
            'form.question' => 'Pertanyaan',
        ];
    }

    public function submit(): void
    {
        $this->validate();

        $product = Product::query()->where('sku', $this->sku)->firstOrFail();

        ProductQuestion::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'name' => Auth::check() ? Auth::user()->name : $this->form['name'],
            'email' => Auth::check() ? Auth::user()->email : $this->form['email'],
            'question' => trim($this->form['question']),
            'is_published' => false,
        ]);

        toast('Pertanyaan Anda terkirim dan menunggu moderasi admin.', 'success');

        $this->reset('form.question');
    }

    public function getQuestionsProperty(): Collection
    {
        return Product::query()
            ->where('sku', $this->sku)
            ->firstOrFail()
            ->questions()
            ->published()
            ->with('user')
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.product-questions', [
            'questions' => $this->questions,
        ]);
    }
}