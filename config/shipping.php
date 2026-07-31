<?php

return [
    'shipping_origin_code' => env('SHIPPING_ORIGIN_CODE', '32.73.14.1002'),
    'komerce' => [
        'api_key' => env('KOMERCE_API_KEY'),
        'base_url' => env('KOMERCE_BASE_URL', 'https://rajaongkir.komerce.id/api/v1'),
    ]
];
