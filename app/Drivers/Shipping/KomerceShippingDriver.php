<?php

declare(strict_types=1);

namespace App\Drivers\Shipping;

use App\Contract\ShippingDriverInterface;
use App\Data\CartData;
use App\Data\RegionData;
use App\Data\ShippingData;
use App\Data\ShippingServiceData;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\DataCollection;

class KomerceShippingDriver implements ShippingDriverInterface
{
    public readonly string $driver;

    public function __construct()
    {
        $this->driver = 'komerce';
    }

    /** @return DataCollection<ShippingServiceData> */
    public function getServices(): DataCollection
    {
        return ShippingServiceData::collect([
            [
                'driver' => $this->driver,
                'code' => 'ninja-reg',
                'courier' => 'ninja',
                'service' => 'STANDARD',
            ],
            [
                'driver' => $this->driver,
                'code' => 'anteraja-reg',
                'courier' => 'anteraja',
                'service' => 'REG',
            ],
            [
                'driver' => $this->driver,
                'code' => 'sicepat-reg',
                'courier' => 'sicepat',
                'service' => 'REG',
            ],
            [
                'driver' => $this->driver,
                'code' => 'pos-reg',
                'courier' => 'pos',
                'service' => 'Pos Reguler',
            ],
            [
                'driver' => $this->driver,
                'code' => 'wahana-reg',
                'courier' => 'wahana',
                'service' => 'Express',
            ],
            [
                'driver' => $this->driver,
                'code' => 'lion-reg',
                'courier' => 'lion',
                'service' => 'REGPACK',
            ],
            [
                'driver' => $this->driver,
                'code' => 'jne-reg',
                'courier' => 'jne',
                'service' => 'REG',
            ],

            [
                'driver' => $this->driver,
                'code' => 'jnt-ez',
                'courier' => 'jnt',
                'service' => 'EZ',
            ],
        ], DataCollection::class);
    }

    public function getRate(
        RegionData $origin,
        RegionData $destination,
        CartData $cart,
        ShippingServiceData $shipping_service
    ): ?ShippingData {
        $apiKey = config('shipping.komerce.api_key');
        $baseUrl = config('shipping.komerce.base_url', 'https://rajaongkir.komerce.id/api/v1');

        if (empty($apiKey)) {
            Log::warning('Komerce API Key belum dikonfigurasi di .env (KOMERCE_API_KEY)');

            return null;
        }

        try {
            $response = Http::timeout(10)
                ->asForm()
                ->withHeaders([
                    'key' => $apiKey,
                ])
                ->post("{$baseUrl}/calculate/domestic-cost", [
                    'origin' => $origin->postal_code,
                    'destination' => $destination->postal_code,
                    'weight' => (int) ($cart->total_weight > 0 ? $cart->total_weight : 1000),
                    'courier' => strtolower($shipping_service->courier),
                ]);

            if ($response->failed()) {
                Log::error('Komerce Rate Error: '.$response->body());

                return null;
            }

            $items = $response->json('data', []);
            if (empty($items)) {
                return null;
            }

            $matched = collect($items)->first(function ($item) use ($shipping_service) {
                return strtolower((string) data_get($item, 'service')) === strtolower($shipping_service->service);
            });

            if (! $matched) {
                $matched = $items[0];
            }

            $courierCode = strtolower((string) data_get($matched, 'code', $shipping_service->courier));
            $courierName = strtoupper($courierCode);
            $serviceName = (string) data_get($matched, 'service', $shipping_service->service);
            $cost = (float) data_get($matched, 'cost', 0);
            $etd = (string) data_get($matched, 'etd', '1-3 Hari');

            $localLogo = null;
            foreach (['png', 'jpg', 'jpeg', 'svg'] as $ext) {
                if (file_exists(public_path("images/couriers/{$courierCode}.{$ext}"))) {
                    $localLogo = url("images/couriers/{$courierCode}.{$ext}");
                    break;
                }
            }
            $logoUrl = $localLogo ?? url("images/couriers/{$courierCode}.svg");

            return new ShippingData(
                $this->driver,
                $courierName,
                $serviceName,
                $etd,
                $cost,
                (int) $cart->total_weight,
                $origin,
                $destination,
                $logoUrl
            );
        } catch (\Throwable $e) {
            Log::error('Komerce Driver Exception: '.$e->getMessage());

            return null;
        }
    }
}
