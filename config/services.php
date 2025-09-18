<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Üçüncü Parti Servisler
    |--------------------------------------------------------------------------
    |
    | Bu dosya, Mailgun, Postmark, AWS gibi üçüncü parti servisler için
    | kimlik bilgilerini saklamak amacıyla kullanılır. Bu dosya, paketlerin
    | çeşitli servis kimlik bilgilerini bulabilmesi için varsayılan bir
    | konum sağlar.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
