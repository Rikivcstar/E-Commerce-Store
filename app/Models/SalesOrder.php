<?php

namespace App\Models;

use App\Models\User;
use App\States\SalesOrder\SalesOrderState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\ModelStates\HasStates;

class SalesOrder extends Model
{
    use HasStates, LogsActivity;

    protected $with = ['items'];
    protected $casts = [
        'status' => SalesOrderState::class,
        'payment_payload' => 'json'
    ];

    public function items() : HasMany
    {
        return $this->hasMany(SalesOrderItem::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['status', 'total']);
    }
}
