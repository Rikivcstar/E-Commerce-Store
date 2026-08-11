<?php

namespace App\Livewire;

use App\Data\ProductData;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductReviews extends Component
{
    public string $sku;

    public bool $canReview = false;

    public bool $hasReviewed = false;

    public array $form = [
        'rating' => 5,
        'title' => '',
        'body' => '',
    ];

    public function mount(ProductData $product)
    {
        $this->sku = $product->sku;

        $this->refreshReviewState();
    }

    public function rules(): array
    {
        return [
            'form.rating' => ['required', 'integer', 'between:1,5'],
            'form.title' => ['nullable', 'string', 'max:120'],
            'form.body' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    public function submit()
    {
        $this->validate();

        $product = Product::where('sku', $this->sku)->firstOrFail();

        $product->reviews()->create([
            'user_id' => Auth::id(),
            'rating' => $this->form['rating'],
            'title' => $this->form['title'],
            'body' => $this->form['body'],
            'is_approved' => false,
        ]);

        toast('Terima kasih! Review menunggu moderasi admin.', 'success');

        $this->reset('form');

        $this->refreshReviewState();
    }

    public function getReviewsProperty(): Collection
    {
        return Product::where('sku', $this->sku)
            ->firstOrFail()
            ->reviews()
            ->approved()
            ->with('user')
            ->latest()
            ->get();
    }

    public function getAverageRatingProperty(): float
    {
        $reviews = $this->reviews;

        if ($reviews->isEmpty()) {
            return 0;
        }

        return round($reviews->avg('rating'), 1);
    }

    public function getRatingDistributionProperty(): array
    {
        $distribution = [
            5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0,
        ];

        foreach ($this->reviews as $review) {
            $distribution[$review->rating] = ($distribution[$review->rating] ?? 0) + 1;
        }

        return $distribution;
    }

    protected function refreshReviewState(): void
    {
        $user = Auth::user();

        if (! $user) {
            $this->canReview = false;
            $this->hasReviewed = false;

            return;
        }

        $product = Product::where('sku', $this->sku)->firstOrFail();

        $this->hasReviewed = ProductReview::query()
            ->where('product_id', $product->getKey())
            ->where('user_id', $user->getKey())
            ->exists();

        $hasPurchased = $product->salesOrderItems()
            ->whereHas('salesOrder', fn ($query) => $query->where('user_id', $user->getKey()))
            ->exists();

        $this->canReview = $hasPurchased && ! $this->hasReviewed;
    }

    public function render()
    {
        return view('livewire.product-reviews', [
            'reviews' => $this->reviews,
            'averageRating' => $this->averageRating,
            'distribution' => $this->ratingDistribution,
        ]);
    }
}