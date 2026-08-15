<?php

namespace App\Models;

use App\States\SalesOrder\Cancel;
use App\States\SalesOrder\Completed;
use App\States\SalesOrder\Pending;
use App\States\SalesOrder\Progress;
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
        'payment_payload' => 'json',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(SalesOrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'total']);
    }

    public function getStatusTimelineAttribute(): array
    {
        $labels = [
            Pending::class => 'Menunggu Pembayaran',
            Progress::class => 'Sedang Diproses',
            Completed::class => 'Pesanan Selesai',
            Cancel::class => 'Pesanan Dibatalkan',
        ];

        $timeline = [];

        $currentStatusClass = is_object($this->status) ? get_class($this->status) : (string) $this->status;

        $timeline[] = [
            'label' => $labels[$currentStatusClass] ?? (string) $this->status,
            'title' => 'Pesanan Dibuat',
            'description' => 'Pesanan berhasil dibuat dan menunggu pembayaran.',
            'timestamp' => $this->created_at,
        ];

        $previous = null;

        $activities = $this->activities()->orderBy('created_at')->orderBy('id')->get();

        foreach ($activities as $activity) {
            $newStatus = (string) data_get($activity->properties, 'attributes.status');

            if (! $newStatus || $newStatus === $previous) {
                continue;
            }

            $previous = $newStatus;

            $description = match ($newStatus) {
                Progress::class => 'Pembayaran berhasil diterima, pesanan sedang disiapkan.',
                Completed::class => 'Pesanan telah selesai diproses dan terkirim.',
                Cancel::class => 'Pesanan dibatalkan karena melewati batas waktu pembayaran atau alasan lainnya.',
                default => 'Status pesanan berubah.',
            };

            $timeline[] = [
                'label' => $labels[$newStatus] ?? $newStatus,
                'title' => $labels[$newStatus] ?? $newStatus,
                'description' => $description,
                'timestamp' => $activity->created_at,
            ];
        }

        return $timeline;
    }
}
