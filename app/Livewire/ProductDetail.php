<?php

namespace App\Livewire;

use App\Data\ProductData;
use App\Models\Category;
use App\Models\Product;
use App\Models\StockWaitlist;
use App\Services\RecentViewedService;
use App\Services\RecommendationService;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class ProductDetail extends Component
{
    public Product $product;

    public ?string $notify_email = null;

    public bool $requested = false;

    public function subscribeStockWaitlist(): void
    {
        $email = auth()->check()
            ? auth()->user()->email
            : ($this->validate(['notify_email' => ['required', 'email']]))['notify_email'];

        $exists = StockWaitlist::query()
            ->where('product_id', $this->product->id)
            ->where('email', $email)
            ->exists();

        if ($exists) {
            toast('Anda sudah terdaftar untuk notifikasi produk ini.', 'info');
            $this->requested = true;

            return;
        }

        StockWaitlist::create([
            'product_id' => $this->product->id,
            'user_id' => auth()->id(),
            'email' => $email,
        ]);

        $this->requested = true;

        toast('Kami akan memberi tahu Anda saat stok tersedia kembali.', 'success');
    }

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

        $metaDescription = str(\Illuminate\Support\Str::of(
            strip_tags($this->product->short_desc ?: (string) $this->product->description)
        )->squish())->limit(160)->toString();

        $reviewCount = $this->product->reviews()->approved()->count();
        $avgRating = $reviewCount > 0
            ? round((float) $this->product->reviews()->approved()->avg('rating'), 1)
            : null;

        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $this->product->name,
            'sku' => $this->product->sku,
            'image' => [$productData->cover_url],
            'description' => \Illuminate\Support\Str::limit(
                strip_tags($this->product->short_desc ?: (string) $this->product->description),
                300
            ),
            'offers' => [
                '@type' => 'Offer',
                'url' => route('product', $this->product->slug),
                'priceCurrency' => 'IDR',
                'price' => number_format($productData->effective_price, 2, '.', ''),
                'availability' => $this->product->stock > 0
                    ? 'https://schema.org/InStock'
                    : 'https://schema.org/OutOfStock',
                'itemCondition' => 'https://schema.org/NewCondition',
            ],
        ];

        if ($reviewCount > 0 && $avgRating !== null) {
            $jsonLd['aggregateRating'] = [
                '@type' => 'AggregateRating',
                'ratingValue' => $avgRating,
                'reviewCount' => $reviewCount,
            ];
        }

        return view('livewire.product-detail', [
            'productData' => $productData,
            'product' => $this->product,
            'recommendations' => $recommendations,
            'recently_viewed' => $recently_viewed,
            'breadcrumbs' => $breadcrumbs,
            'metaDescription' => $metaDescription,
            'jsonLd' => $jsonLd,
        ])->layout('components.layouts.app', ['title' => $this->product->name]);
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
