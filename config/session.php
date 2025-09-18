<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Varsayılan Oturum Sürücüsü
    |--------------------------------------------------------------------------
    |
    | Bu seçenek, gelen istekler için kullanılacak varsayılan oturum
    | sürücüsünü belirler. Laravel, oturum verilerini kalıcı olarak
    | saklamak için çeşitli depolama seçeneklerini destekler.
    | Veritabanı depolama iyi bir varsayılan tercihtir.
    |
    | Desteklenen: "file", "cookie", "database", "apc",
    |              "memcached", "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Oturum Süresi
    |--------------------------------------------------------------------------
    |
    | Burada, oturumun ne kadar süre boyunca boşta kalabileceğini
    | dakika cinsinden belirtebilirsiniz. Tarayıcı kapandığında
    | oturumun hemen sona ermesini istiyorsanız,
    | expire_on_close ayarını kullanabilirsiniz.
    |
    */

    'lifetime' => env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    /*
    |--------------------------------------------------------------------------
    | Oturum Şifreleme
    |--------------------------------------------------------------------------
    |
    | Bu seçenek, tüm oturum verilerinin saklanmadan önce şifrelenmesini
    | kolayca belirtmenizi sağlar. Laravel tüm şifrelemeyi otomatik olarak
    | gerçekleştirir ve oturumu normal şekilde kullanabilirsiniz.
    |
    */

    'encrypt' => env('SESSION_ENCRYPT', false),

    /*
    |--------------------------------------------------------------------------
    | Oturum Dosya Konumu
    |--------------------------------------------------------------------------
    |
    | "file" oturum sürücüsü kullanıldığında, oturum dosyaları diske
    | yerleştirilir. Varsayılan depolama konumu burada tanımlanmıştır;
    | ancak isterseniz farklı bir konum da belirtebilirsiniz.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Oturum Veritabanı Bağlantısı
    |--------------------------------------------------------------------------
    |
    | "database" veya "redis" oturum sürücüleri kullanıldığında,
    | bu oturumları yönetmek için kullanılacak bağlantıyı
    | burada belirtebilirsiniz. Bu bağlantı, veritabanı
    | yapılandırma seçeneklerinizde tanımlı olmalıdır.
    |
    */

    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Oturum Veritabanı Tablosu
    |--------------------------------------------------------------------------
    |
    | "database" oturum sürücüsü kullanıldığında, oturumların
    | saklanacağı tabloyu burada belirtebilirsiniz.
    | Varsayılan bir tablo tanımlanmıştır, ancak isterseniz
    | başka bir tablo adı da kullanabilirsiniz.
    |
    */

    'table' => env('SESSION_TABLE', 'sessions'),

    /*
    |--------------------------------------------------------------------------
    | Oturum Önbellek Deposu
    |--------------------------------------------------------------------------
    |
    | Framework'ün önbellek tabanlı oturum arka uçlarından biri
    | kullanıldığında, oturum verilerinin istekler arasında
    | saklanacağı önbellek deposunu burada tanımlayabilirsiniz.
    | Bu değer, tanımlı önbellek depolarından biriyle eşleşmelidir.
    |
    | Etkileyenler: "apc", "dynamodb", "memcached", "redis"
    |
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Oturum Temizleme Piyangosu
    |--------------------------------------------------------------------------
    |
    | Bazı oturum sürücüleri, eski oturumları temizlemek için
    | depolama konumlarını manuel olarak süpürmelidir.
    | Aşağıda, bu işlemin bir istekte gerçekleşme olasılığı
    | belirtilmiştir. Varsayılan olarak 100'de 2 ihtimal vardır.
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Oturum Çerezi Adı
    |--------------------------------------------------------------------------
    |
    | Framework tarafından oluşturulan oturum çerezinin adını
    | burada değiştirebilirsiniz. Genellikle bu değeri
    | değiştirmenize gerek yoktur çünkü güvenlik açısından
    | anlamlı bir katkı sağlamaz.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Oturum Çerezi Yolu
    |--------------------------------------------------------------------------
    |
    | Oturum çerezi yolu, çerezin hangi yollar için geçerli
    | olacağını belirler. Genellikle bu, uygulamanızın kök
    | yolu olur; ancak gerekirse değiştirebilirsiniz.
    |
    */

    'path' => env('SESSION_PATH', '/'),

    /*
    |--------------------------------------------------------------------------
    | Oturum Çerezi Alan Adı
    |--------------------------------------------------------------------------
    |
    | Bu değer, oturum çerezinin hangi alan adı ve alt alan adlarında
    | geçerli olacağını belirler. Varsayılan olarak kök alan adı
    | ve tüm alt alan adları için geçerlidir. Genellikle
    | bu değeri değiştirmenize gerek yoktur.
    |
    */

    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | Sadece HTTPS ile Gönderilen Çerezler
    |--------------------------------------------------------------------------
    |
    | Bu seçeneği true olarak ayarlarsanız, oturum çerezleri
    | yalnızca tarayıcı HTTPS bağlantısı kurduğunda sunucuya
    | geri gönderilir. Bu, çerezin güvenli olmayan
    | ortamlarda gönderilmesini engeller.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE'),

    /*
    |--------------------------------------------------------------------------
    | Sadece HTTP ile Erişim
    |--------------------------------------------------------------------------
    |
    | Bu değeri true olarak ayarlamak, JavaScript'in çerezin
    | değerine erişmesini engeller ve çerez yalnızca
    | HTTP protokolü üzerinden erişilebilir olur.
    | Bu seçeneği devre dışı bırakmanız önerilmez.
    |
    */

    'http_only' => env('SESSION_HTTP_ONLY', true),

    /*
    |--------------------------------------------------------------------------
    | Same-Site Çerezler
    |--------------------------------------------------------------------------
    |
    | Bu seçenek, çerezlerin siteler arası isteklerde nasıl
    davranacağını belirler ve CSRF saldırılarını önlemeye
    yardımcı olabilir. Varsayılan olarak "lax" ayarlanmıştır.
    |
    | Daha fazla bilgi: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Set-Cookie#samesitesamesite-value
    |
    | Desteklenen: "lax", "strict", "none", null
    |
    */

    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    /*
    |--------------------------------------------------------------------------
    | Bölümlenmiş Çerezler
    |--------------------------------------------------------------------------
    |
    | Bu değeri true olarak ayarlamak, çerezi üst düzey siteye
    bağlar ve siteler arası bağlamda kullanılmasını sağlar.
    | Bölümlenmiş çerezler, "secure" olarak işaretlendiğinde
    ve Same-Site özelliği "none" olarak ayarlandığında
    tarayıcı tarafından kabul edilir.
    |
    */

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

];
