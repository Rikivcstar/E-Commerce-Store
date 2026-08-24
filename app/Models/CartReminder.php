<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartReminder extends Model
{
    protected $fillable = [
        'user_id',
        'reminded_at',
    ];

    protected $casts = [
        'reminded_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}