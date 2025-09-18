<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Varsayılan Mailer
    |--------------------------------------------------------------------------
    |
    | Bu seçenek, tüm e-posta mesajlarını göndermek için kullanılan varsayılan
    | mailer'ı kontrol eder. Mesaj gönderilirken başka bir mailer açıkça
    | belirtilmediği sürece bu mailer kullanılır. Ek mailer'lar aşağıdaki
    | "mailers" dizisi içinde yapılandırılabilir. Her tür için örnekler verilmiştir.
    |
    */

    'default' => env('MAIL_MAILER', 'log'),

    /*
    |--------------------------------------------------------------------------
    | Mailer Yapılandırmaları
    |--------------------------------------------------------------------------
    |
    | Burada uygulamanızda kullanılan tüm mailer'ları ve ilgili ayarlarını
    | yapılandırabilirsiniz. Sizin için birkaç örnek tanımlanmıştır ve
    | uygulamanızın ihtiyaçlarına göre yenilerini ekleyebilirsiniz.
    |
    | Laravel, e-posta gönderimi için çeşitli "transport" sürücülerini destekler.
    | Aşağıda hangi sürücüyü kullanmak istediğinizi belirtebilirsiniz.
    | Gerekirse ek mailer'lar da ekleyebilirsiniz.
    |
    | Desteklenen: "smtp", "sendmail", "mailgun", "ses", "ses-v2",
    |              "postmark", "log", "array", "failover", "roundrobin"
    |
    */

    'mailers' => [
        // Mailer tanımları burada yer alıyor...
    ],

    /*
    |--------------------------------------------------------------------------
    | Global "Gönderen" Adresi
    |--------------------------------------------------------------------------
    |
    | Uygulamanız tarafından gönderilen tüm e-postaların aynı adresten
    | gönderilmesini isteyebilirsiniz. Burada, uygulamanız tarafından
    | gönderilen tüm e-postalar için kullanılacak ad ve adresi belirtebilirsiniz.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

];
