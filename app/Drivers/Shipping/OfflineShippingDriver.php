<?php
declare(strict_types=1);

namespace App\Drivers\Shipping;

use App\Contract\ShippingDriverInterface;
use App\Data\CartData;
use App\Data\RegionData;
use App\Data\ShippingData;
use App\Data\ShippingServiceData;
use Spatie\LaravelData\DataCollection;

class OfflineShippingDriver implements ShippingDriverInterface
{

    public readonly string $driver;

    public function __construct()
    {
        $this->driver = 'offline';
    }

    /** @return DataCollection<ShippingServiceData> */
    public function getServices() : DataCollection
    {
        // Perbaikan: gunakan array of array, bukan array asosiatif biasa
        return ShippingServiceData::collect([
            [
                'driver' => $this->driver,
                'code' => 'offline-flat-15',
                'courier' => 'internal Courier',
                'service' => 'Sameday'
            ],
            [
                'driver' => $this->driver,
                'code' => 'offline-flat-5',
                'courier' => 'internal Courier',
                'service' => 'Reguler'
            ]
        ], DataCollection::class);
    }


    public function getRate(
        RegionData $origin,
        RegionData $destination,
        CartData $cart,
        ShippingServiceData $shipping_service
    ) : ?ShippingData
    {
        $data = null;

        switch($shipping_service->code){
            case 'offline-flat-15':
                $data = ShippingData::from([
                    'driver' => $this->driver,
                    'courier' => $shipping_service->courier,
                    'service' => $shipping_service->service,
                    'estimated_delivery' => '1-2 Jam',
                    'cost' => 15000,
                    'weight' => $cart->total_weight,
                    'origin' => $origin,
                    'destination' => $destination,
                    'logo_url' => 'https://cdn-icons-png.flaticon.com/512/2830/2830289.png'
                ]);
                break;
            case 'offline-flat-5':
                $data = ShippingData::from([
                    'driver' => $this->driver,
                    'courier' => $shipping_service->courier,
                    'service' => $shipping_service->service,
                    'estimated_delivery' => '1 Hari',
                    'cost' => 5000,
                    'weight' => $cart->total_weight,
                    'origin' => $origin,
                    'destination' => $destination,
                    'logo_url' => 'https://cdn-icons-png.flaticon.com/512/2830/2830289.png'
                ]);
                break;
        }

        return $data;
    }
}
