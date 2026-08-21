<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Membantu menampilkan link pelacakan resi pengiriman berdasarkan kurir.
 * Link mengarah ke halaman tracking resmi masing-masing ekspedisi.
 */
class ShipmentTrackingService
{
    public function getUrl(?string $courier, ?string $receiptNumber): ?string
    {
        if (blank($receiptNumber)) {
            return null;
        }

        $courier = strtolower((string) $courier);

        return match (true) {
            str_contains($courier, 'jne') => "https://www.jne.co.id/id/beranda/tracking?awb={$receiptNumber}",
            str_contains($courier, 'jnt') => "https://jnt.co.id/track/{$receiptNumber}",
            str_contains($courier, 'sicepat') => "https://sicepat.com/index.php/track?no_resi={$receiptNumber}",
            str_contains($courier, 'ninja') => "https://www.ninjaxpress.co/web/track/{$receiptNumber}",
            str_contains($courier, 'anteraja') => "https://anteraja.id/tracking-titipan?awb={$receiptNumber}",
            str_contains($courier, 'pos indonesia') || str_contains($courier, 'pos') => "https://www.posindonesia.co.id/tracking?awb={$receiptNumber}",
            str_contains($courier, 'wahana') => "https://wahana.com/web/track/{$receiptNumber}",
            default => null,
        };
    }
}