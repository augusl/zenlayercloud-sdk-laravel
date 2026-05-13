<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default Connection
    |--------------------------------------------------------------------------
    |
    | Name of the connection used when ZenlayerCloud::vm() / ::zec() is called
    | without an explicit connection name.
    |
    */
    'default' => env('ZENLAYER_CONNECTION', 'default'),

    /*
    |--------------------------------------------------------------------------
    | Connections
    |--------------------------------------------------------------------------
    |
    | Each connection holds a Zenlayer Cloud API credential and HTTP options.
    | Add more connections to access multiple accounts from one application —
    | e.g. ZenlayerCloud::vm('staging')->DescribeZones($request).
    |
    */
    'connections' => [
        'default' => [
            'secret_key_id' => env('ZENLAYER_SECRET_KEY_ID'),
            'secret_key_password' => env('ZENLAYER_SECRET_KEY_PASSWORD'),

            'endpoint' => env('ZENLAYER_ENDPOINT', 'console.zenlayer.com'),
            'scheme' => env('ZENLAYER_SCHEME', 'https'),
            'timeout' => (int) env('ZENLAYER_TIMEOUT', 60),

            'retry' => (bool) env('ZENLAYER_RETRY', false),
            'retry_max' => (int) env('ZENLAYER_RETRY_MAX', 3),

            'debug' => (bool) env('ZENLAYER_DEBUG', false),
            'proxy' => env('ZENLAYER_PROXY'),
            'request_client' => env('ZENLAYER_REQUEST_CLIENT'),
        ],
    ],
];
