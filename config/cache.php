<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Varsayılan Önbellek Deposu
    |--------------------------------------------------------------------------
    |
    | Bu seçenek, framework tarafından kullanılacak varsayılan önbellek
    | deposunu kontrol eder. Uygulama içinde bir önbellek işlemi çalıştırılırken
    | başka bir bağlantı açıkça belirtilmemişse bu bağlantı kullanılır.
    |
    */

    'default' => env('CACHE_STORE', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Önbellek Depoları
    |--------------------------------------------------------------------------
    |
    | Burada uygulamanız için tüm önbellek "depolarını" ve sürücülerini
    | tanımlayabilirsiniz. Aynı önbellek sürücüsü için birden fazla depo
    | tanımlayarak farklı veri gruplarını ayrı ayrı saklayabilirsiniz.
    |
    | Desteklenen sürücüler: "apc", "array", "database", "file", "memcached",
    |                         "redis", "dynamodb", "octane", "null"
    |
    */

    'stores' => [

        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

        'database' => [
            'driver' => 'database',
            'table' => env('DB_CACHE_TABLE', 'cache'),
            'connection' => env('DB_CACHE_CONNECTION'),
            'lock_connection' => env('DB_CACHE_LOCK_CONNECTION'),
        ],

        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
            'lock_path' => storage_path('framework/cache/data'),
        ],

        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'sasl' => [
                env('MEMCACHED_USERNAME'),
                env('MEMCACHED_PASSWORD'),
            ],
            'options' => [
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => env('REDIS_CACHE_CONNECTION', 'cache'),
            'lock_connection' => env('REDIS_CACHE_LOCK_CONNECTION', 'default'),
        ],

        'dynamodb' => [
            'driver' => 'dynamodb',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'table' => env('DYNAMODB_CACHE_TABLE', 'cache'),
            'endpoint' => env('DYNAMODB_ENDPOINT'),
        ],

        'octane' => [
            'driver' => 'octane',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Önbellek Anahtar Ön Eki
    |--------------------------------------------------------------------------
    |
    | APC, database, memcached, Redis ve DynamoDB önbellek depoları kullanılırken,
    | aynı önbelleği kullanan başka uygulamalar olabilir. Bu nedenle, çakışmaları
    | önlemek için tüm önbellek anahtarlarına bir ön ek eklenebilir
    |
    */

    'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_cache_'),

];
