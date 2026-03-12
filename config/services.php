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
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
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

    'midtrans' => [
        'merchant_id' => env('MIDTRANS_MERCHANT_ID'),
        'client_key' => env('MIDTRANS_CLIENT_KEY'),
        'server_key' => env('MIDTRANS_SERVER_KEY'),
        'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
        'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
        'is_3ds' => env('MIDTRANS_IS_3DS', true),
    ],

    'apicoid' => [
        'api_key' => env('APICOID_API_KEY'),
        'base_url' => env('APICOID_BASE_URL', 'https://use.api.co.id'),
        'origin_village_code' => env('APICOID_ORIGIN_VILLAGE_CODE', ''),
        'provinces_endpoint' => env('APICOID_PROVINCES_ENDPOINT', '/regional/indonesia/provinces'),
        'cities_endpoint' => env('APICOID_CITIES_ENDPOINT', '/regional/indonesia/regencies'),
        'subdistricts_endpoint' => env('APICOID_SUBDISTRICTS_ENDPOINT', '/regional/indonesia/districts'),
        'villages_endpoint' => env('APICOID_VILLAGES_ENDPOINT', '/regional/indonesia/villages'),
        'cost' => env('APICOID_COST_ENDPOINT', '/expedition/shipping-cost'),
    ],

];
