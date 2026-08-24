<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductQuestion extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'name',
        'email',
        'question',
        'answer',
        'answered_at',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'answered_at' => 'datetime',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('is_published', false);
    }
}