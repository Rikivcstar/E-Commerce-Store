<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserCartItem extends Model
{
    protected $fillable = [
        'user_id',
        'sku',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}