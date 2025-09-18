<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Varsayılan Dosya Sistemi Diski
    |--------------------------------------------------------------------------
    |
    | Burada framework tarafından kullanılacak varsayılan dosya sistemi diskini
    | belirtebilirsiniz. Uygulamanız için "local" diskin yanı sıra çeşitli
    | bulut tabanlı diskler de dosya depolama için kullanılabilir.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Dosya Sistemi Diskleri
    |--------------------------------------------------------------------------
    |
    | Aşağıda, uygulamanız için gerekli olan kadar dosya sistemi diski
    | yapılandırabilirsiniz. Aynı sürücü için birden fazla disk tanımlayarak
    | farklı veri gruplarını ayrı ayrı saklayabilirsiniz.
    |
    | Desteklenen Sürücüler: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Sembolik Bağlantılar
    |--------------------------------------------------------------------------
    |
    | `storage:link` Artisan komutu çalıştırıldığında oluşturulacak sembolik
    | bağlantıları burada yapılandırabilirsiniz. Dizi anahtarları bağlantı
    | konumlarını, değerler ise hedeflerini temsil etmelidir.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
