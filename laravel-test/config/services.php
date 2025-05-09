<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
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

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'easymoney' => [
        'gateway' => 'easymoney',
        'base_uri' => env('EASY_MONEY_URI'),
        'client_class' => App\Clients\EasyMoneyClient::class,
        'class' => App\Processors\EasyMoneyProcessor::class,
    ],
    'superwalletz' => [
        'gateway' => 'superwalletz',
        'base_uri' => env('SUPER_WALLET_URI'),
        'client_class' => App\Clients\SuperWalletClient::class,
        'class' =>  App\Processors\SuperWalletProcessor::class,
        'callback_uri' => env('APP_URL') . '/api/webhook',
    ]

];
