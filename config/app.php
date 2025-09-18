<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Uygulama Adı
    |--------------------------------------------------------------------------
    |
    | Bu değer, uygulamanızın adıdır ve framework tarafından bildirimlerde
    | veya uygulama adının gösterilmesi gereken diğer UI öğelerinde kullanılır.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Uygulama Ortamı
    |--------------------------------------------------------------------------
    |
    | Bu değer, uygulamanızın şu anda hangi "ortamda" çalıştığını belirler.
    | Bu, uygulamanın kullandığı çeşitli servisleri nasıl yapılandırmak
    | istediğinizi belirleyebilir. ".env" dosyanızda ayarlayın.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Uygulama Hata Ayıklama Modu
    |--------------------------------------------------------------------------
    |
    | Uygulamanız hata ayıklama modundayken, oluşan her hatada ayrıntılı
    | hata mesajları ve yığın izleri gösterilir. Devre dışı bırakıldığında
    | basit ve genel bir hata sayfası gösterilir.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Uygulama URL'si
    |--------------------------------------------------------------------------
    |
    | Bu URL, Artisan komut satırı aracı kullanılırken URL'lerin doğru
    | şekilde oluşturulabilmesi için konsol tarafından kullanılır.
    | Uygulamanın kök dizinine ayarlanmalıdır.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Uygulama Zaman Dilimi
    |--------------------------------------------------------------------------
    |
    | Burada uygulamanız için varsayılan zaman dilimini belirtebilirsiniz.
    | Bu ayar PHP'nin tarih ve zaman işlevleri tarafından kullanılır.
    | Varsayılan olarak "UTC" olarak ayarlanmıştır.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'UTC'),

    /*
    |--------------------------------------------------------------------------
    | Uygulama Dil Yapılandırması
    |--------------------------------------------------------------------------
    |
    | Bu ayar, Laravel'in çeviri / yerelleştirme yöntemleri tarafından
    | kullanılacak varsayılan dili belirler. Çeviri dizgileri için
    | kullanmayı planladığınız herhangi bir dil olabilir.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Şifreleme Anahtarı
    |--------------------------------------------------------------------------
    |
    | Bu anahtar, Laravel'in şifreleme servisleri tarafından kullanılır ve
    | tüm şifrelenmiş değerlerin güvenliğini sağlamak için rastgele 32
    | karakterlik bir dizeye ayarlanmalıdır. Uygulamayı dağıtmadan önce
    | bunu yapmalısınız.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Bakım Modu Sürücüsü
    |--------------------------------------------------------------------------
    |
    | Bu yapılandırma seçenekleri, Laravel'in "bakım modu" durumunu
    | belirlemek ve yönetmek için kullanılan sürücüyü tanımlar.
    | "cache" sürücüsü, bakım modunun birden fazla makinede
    | kontrol edilmesini sağlar.
    |
    | Desteklenen sürücüler: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
