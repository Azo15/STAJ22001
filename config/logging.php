<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

return [

    /*
    |--------------------------------------------------------------------------
    | Varsayılan Log Kanalı
    |--------------------------------------------------------------------------
    |
    | Bu seçenek, log mesajlarını yazmak için kullanılan varsayılan log
    | kanalını tanımlar. Burada belirtilen değer, aşağıda yapılandırılmış
    | "kanallar" listesindeki bir kanal adıyla eşleşmelidir.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Kullanımdan Kaldırma Uyarıları Log Kanalı
    |--------------------------------------------------------------------------
    |
    | Bu seçenek, PHP ve kütüphane özelliklerinin kullanımdan kaldırılmasıyla
    | ilgili uyarıların loglanacağı kanalı kontrol eder. Bu sayede uygulamanız
    | gelecekteki büyük sürümlere hazırlanabilir.
    |
    */

    'deprecations' => [
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        'trace' => env('LOG_DEPRECATIONS_TRACE', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Kanalları
    |--------------------------------------------------------------------------
    |
    | Burada uygulamanız için log kanallarını yapılandırabilirsiniz. Laravel,
    | güçlü log işleyicileri ve biçimlendiriciler içeren Monolog PHP log
    | kütüphanesini kullanır. Bunları özgürce kullanabilirsiniz.
    |
    | Kullanılabilir Sürücüler: "single", "daily", "slack", "syslog",
    |                            "errorlog", "monolog", "custom", "stack"
    |
    */

    'channels' => [
        // Kanal tanımları burada yer alıyor...
    ],

];
