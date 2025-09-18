<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Kimlik Doğrulama Varsayılanları
    |--------------------------------------------------------------------------
    |
    | Bu seçenek, uygulamanız için varsayılan kimlik doğrulama "guard"ını
    | ve parola sıfırlama "broker"ını tanımlar. Gerektiğinde bu değerleri
    | değiştirebilirsiniz, ancak çoğu uygulama için ideal bir başlangıçtır.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Kimlik Doğrulama Guard'ları
    |--------------------------------------------------------------------------
    |
    | Burada uygulamanız için tüm kimlik doğrulama guard'larını tanımlayabilirsiniz.
    | Elbette, oturum depolaması ve Eloquent kullanıcı sağlayıcısını kullanan
    | harika bir varsayılan yapılandırma sizin için tanımlanmıştır.
    |
    | Tüm guard'lar bir kullanıcı sağlayıcısına sahiptir. Bu sağlayıcılar,
    | kullanıcıların veritabanından veya uygulamanın kullandığı diğer
    | depolama sistemlerinden nasıl alınacağını tanımlar. Genellikle Eloquent kullanılır.
    |
    | Desteklenen: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Kullanıcı Sağlayıcıları
    |--------------------------------------------------------------------------
    |
    | Tüm kimlik doğrulama guard'ları bir kullanıcı sağlayıcısına sahiptir.
    | Bu sağlayıcılar, kullanıcıların veritabanından veya uygulamanın kullandığı
    | diğer depolama sistemlerinden nasıl alınacağını tanımlar. Genellikle Eloquent kullanılır.
    |
    | Birden fazla kullanıcı tablonuz veya modeliniz varsa, her biri için
    | ayrı sağlayıcılar yapılandırabilirsiniz. Bu sağlayıcılar, tanımladığınız
    | ek guard'lara atanabilir.
    |
    | Desteklenen: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Parola Sıfırlama
    |--------------------------------------------------------------------------
    |
    | Bu yapılandırma seçenekleri, Laravel'in parola sıfırlama işlevinin
    | davranışını tanımlar. Token saklama için kullanılan tablo ve
    | kullanıcıları almak için çağrılan sağlayıcıyı içerir.
    |
    | Süre, her sıfırlama token'ının geçerli sayılacağı dakika sayısıdır.
    | Bu güvenlik özelliği, token'ların kısa ömürlü olmasını sağlar.
    |
    | Throttle ayarı, bir kullanıcının yeni parola sıfırlama token'ı
    | oluşturmak için beklemesi gereken saniye sayısını belirtir.
    | Bu, çok sayıda token üretimini engeller.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Parola Onay Zaman Aşımı
    |--------------------------------------------------------------------------
    |
    | Burada, parola onay penceresinin ne kadar süre sonra zaman aşımına
    | uğrayacağını ve kullanıcıların parolalarını yeniden girmeleri
    | gerektiğini tanımlayabilirsiniz. Varsayılan olarak üç saat sürer.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
