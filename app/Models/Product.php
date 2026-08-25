<?php

namespace App\Models;

use App\Events\ProductRestockedEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

class Product extends Model implements HasMedia
{
    //
    use HasTags, InteractsWithMedia, LogsActivity;

    protected static function booted(): void
    {
        // Ketika stok berubah dari kosong menjadi tersedia,
        // beri tahu pengguna yang mendaftar "notify me".
        static::updating(function (Product $product) {
            $oldStock = (int) $product->getOriginal('stock');

            if ($oldStock < 1 && $product->stock >= 1) {
                event(new ProductRestockedEvent($product));
            }
        });
    }

    protected $casts = [
        'sale_price' => 'float',
        'sale_starts_at' => 'datetime',
        'sale_ends_at' => 'datetime',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(ProductQuestion::class);
    }

    public function wishlistedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wishlists')->withTimestamps();
    }

    public function salesOrderItems(): HasMany
    {
        return $this->hasMany(SalesOrderItem::class, 'sku', 'sku');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile()->useDisk('public');
        $this->addMediaCollection('gallery')->useDisk('public');
    }

    public function registerAllMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('cover')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'slug', 'stock']);
    }

    public function scopeLowStock($query, int $threshold = 5)
    {
        return $query->where('stock', '<=', $threshold);
    }

    /**
     * Flash sale aktif ketika harga sale terisi dan berada di dalam periode.
     */
    public function getIsOnSaleAttribute(): bool
    {
        if ($this->sale_price === null || (float) $this->sale_price <= 0) {
            return false;
        }

        $started = $this->sale_starts_at === null || $this->sale_starts_at->lessThanOrEqualTo(now());
        $notEnded = $this->sale_ends_at === null || $this->sale_ends_at->greaterThanOrEqualTo(now());

        return $started && $notEnded;
    }

    public function getEffectivePriceAttribute(): float
    {
        return $this->is_on_sale ? (float) $this->sale_price : (float) $this->price;
    }

    public function getDiscountPercentAttribute(): int
    {
        if (! $this->is_on_sale || (float) $this->price <= 0) {
            return 0;
        }

        return (int) round((1 - ((float) $this->sale_price / (float) $this->price)) * 100);
    }

    public function getCoverUrlAttribute(): string
    {
        $url = $this->getFirstMediaUrl('cover');
        if (! empty($url)) {
            return $url;
        }

        $imageMap = [
            'wireless-noise-canceling-headphones-pro' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&q=80',
            'smartwatch-series-9-oled-display' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&q=80',
            'mechanical-rgb-wireless-gaming-keyboard' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=800&q=80',
            'ergonomic-precision-wireless-mouse' => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?w=800&q=80',
            'portable-waterproof-bluetooth-speaker' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=800&q=80',
            'minimalist-heavyweight-cotton-t-shirt' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=800&q=80',
            'classic-denim-trucker-jacket-modern-fit' => 'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?w=800&q=80',
            'oversized-streetwear-fleece-hoodie-black' => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=800&q=80',
            'casual-wool-blend-slim-chino-pants' => 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=800&q=80',
            'minimalist-linen-short-sleeve-shirt' => 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?w=800&q=80',
            'classic-heritage-leather-low-top-sneakers' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=800&q=80',
            'ultralight-mesh-running-shoes-white' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&q=80',
            'classic-leather-chelsea-boots-dark-brown' => 'https://images.unsplash.com/photo-1638247025967-b4e38f787b76?w=800&q=80',
            'comfort-slide-sandals-black-matte' => 'https://images.unsplash.com/photo-1603808033192-082d6919d3e1?w=800&q=80',
            'automatic-stainless-steel-chronograph-watch' => 'https://images.unsplash.com/photo-1524805444758-089113d48a6d?w=800&q=80',
            'genuine-leather-bifold-slim-wallet' => 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=800&q=80',
            'polarized-classic-acetate-sunglasses' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=800&q=80',
            'nordic-minimalist-ceramic-desk-lamp' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=800&q=80',
            'stainless-steel-insulated-thermal-water-bottle' => 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=800&q=80',
            'aromatherapy-essential-oil-diffuser-500ml' => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=800&q=80',
        ];

        return $imageMap[$this->slug] ?? 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&q=80';
    }

    public function getGalleryUrlsAttribute(): array
    {
        $gallery = $this->getMedia('gallery')->map(fn ($record) => $record->getUrl())->toArray();

        return count($gallery) > 0 ? $gallery : [$this->cover_url];
    }

    public function getCollectionNameAttribute(): string
    {
        $tagCollection = $this->tags()->where('type', 'collection')->pluck('name')->first();
        if ($tagCollection) {
            return $tagCollection;
        }

        $category = $this->categories()->first();
        if ($category) {
            return $category->name;
        }

        return $this->short_desc ?: 'Curated Goods';
    }

    public function getSoldCountAttribute(): int
    {
        $sum = (int) $this->salesOrderItems()->sum('quantity');

        return $sum > 0 ? $sum : (($this->id * 17) % 85 + 15);
    }
}
