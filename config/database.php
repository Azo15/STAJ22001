<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Varsayılan Veritabanı Bağlantı Adı
    |--------------------------------------------------------------------------
    |
    | Aşağıdaki veritabanı bağlantılarından hangisini varsayılan olarak
    | kullanmak istediğinizi burada belirtebilirsiniz. Başka bir bağlantı
    | açıkça belirtilmediği sürece sorgular bu bağlantı üzerinden çalışır.
    |
    */

    'default' => env('DB_CONNECTION', 'sqlite'),

    /*
    |--------------------------------------------------------------------------
    | Veritabanı Bağlantıları
    |--------------------------------------------------------------------------
    |
    | Aşağıda uygulamanız için tanımlanmış tüm veritabanı bağlantıları yer alır.
    | Laravel tarafından desteklenen her veritabanı sistemi için örnek
    | yapılandırmalar sağlanmıştır. Bağlantı ekleyip kaldırmakta özgürsünüz.
    |
    */

    'connections' => [
        // Bağlantı tanımları burada yer alıyor...
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Kayıt Tablosu
    |--------------------------------------------------------------------------
    |
    | Bu tablo, uygulamanızda daha önce çalıştırılmış olan migration'ları
    | takip eder. Bu bilgi sayesinde disk üzerindeki hangi migration'ların
    | veritabanında henüz çalıştırılmadığı anlaşılabilir.
    |
    */

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Veritabanları
    |--------------------------------------------------------------------------
    |
    | Redis, açık kaynaklı, hızlı ve gelişmiş bir anahtar-değer deposudur.
    | Memcached gibi sistemlere göre daha zengin komutlar sunar.
    | Bağlantı ayarlarınızı burada tanımlayabilirsiniz.
    |
    */

    'redis' => [
        // Redis yapılandırması burada yer alıyor...
    ],

];
