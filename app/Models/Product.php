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

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
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
}
