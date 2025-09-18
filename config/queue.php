<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Varsayılan Kuyruk Bağlantı Adı
    |--------------------------------------------------------------------------
    |
    | Laravel'in kuyruk sistemi, tek bir birleşik API üzerinden çeşitli
    | arka uçları destekler. Her biri için aynı sözdizimini kullanarak
    | kolay erişim sağlar. Varsayılan bağlantı aşağıda tanımlanmıştır.
    |
    */

    'default' => env('QUEUE_CONNECTION', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Kuyruk Bağlantıları
    |--------------------------------------------------------------------------
    |
    | Burada uygulamanızda kullanılan her kuyruk arka ucu için bağlantı
    | seçeneklerini yapılandırabilirsiniz. Laravel tarafından desteklenen
    | her arka uç için örnek yapılandırmalar sağlanmıştır. Yeni bağlantılar
    | eklemekte özgürsünüz.
    |
    | Sürücüler: "sync", "database", "beanstalkd", "sqs", "redis", "null"
    |
    */

    'connections' => [
        // Bağlantı tanımları burada yer alıyor...
    ],

    /*
    |--------------------------------------------------------------------------
    | İş Gruplama (Job Batching)
    |--------------------------------------------------------------------------
    |
    | Aşağıdaki seçenekler, iş gruplama bilgilerini saklayan veritabanı ve
    | tabloyu yapılandırır. Bu seçenekler, uygulamanızda tanımlanmış
    | herhangi bir veritabanı bağlantısına ve tabloya göre güncellenebilir.
    |
    */

    'batching' => [
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'job_batches',
    ],

    /*
    |--------------------------------------------------------------------------
    | Başarısız Kuyruk İşleri
    |--------------------------------------------------------------------------
    |
    | Bu seçenekler, başarısız kuyruk işlerinin loglanma davranışını
    | yapılandırır. Laravel, başarısız işleri basit bir dosyada veya
    | veritabanında saklamayı destekler.
    |
    | Desteklenen sürücüler: "database-uuids", "dynamodb", "file", "null"
    |
    */

    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'failed_jobs',
    ],

];
