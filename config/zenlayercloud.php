<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default Connection
    |--------------------------------------------------------------------------
    |
    | Name of the connection used when ZenlayerCloud::vm(), ::ipt(), or ::zec()
    | is called without an explicit connection name.
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
            // Authenticate with an AccessKey pair (HMAC signing)...
            'secret_key_id' => env('ZENLAYER_SECRET_KEY_ID'),
            'secret_key_password' => env('ZENLAYER_SECRET_KEY_PASSWORD'),

            // ...or with a personal access token (Bearer auth). When a token is
            // set it takes precedence over the AccessKey pair above.
            // Generate one at https://console.zenlayer.com/accessToken.
            'token' => env('ZENLAYER_TOKEN'),

            'endpoint' => env('ZENLAYER_ENDPOINT', 'console.zenlayer.com'),
            'scheme' => env('ZENLAYER_SCHEME', 'https'),
            'timeout' => (int) env('ZENLAYER_TIMEOUT', 60),

            'retry' => (bool) env('ZENLAYER_RETRY', false),
            'retry_max' => (int) env('ZENLAYER_RETRY_MAX', 3),

            // Official SDK behavior: retry HTTP 429 / REQUEST_LIMIT_EXCEEDED
            // three times with exponential backoff (1s, 2s, 4s). A numeric
            // Retry-After header is honored as the minimum delay. Set the
            // retry count to 0 to disable it.
            'rate_limit_max_retries' => (int) env('ZENLAYER_RATE_LIMIT_MAX_RETRIES', 3),
            'rate_limit_retry_delay_ms' => (int) env('ZENLAYER_RATE_LIMIT_RETRY_DELAY_MS', 1000),

            'debug' => (bool) env('ZENLAYER_DEBUG', false),
            'proxy' => env('ZENLAYER_PROXY'),

            // TLS verification: true (default), false, or a CA bundle path.
            'verify' => env('ZENLAYER_VERIFY', true),

            'request_client' => env('ZENLAYER_REQUEST_CLIENT'),
        ],
    ],
];
