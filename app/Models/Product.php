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

        return $url ?: asset('images/placeholder.png');
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
