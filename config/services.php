<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
    'client_id' => '1222787364451080',
    'client_secret' => 'a7cba7dbb0afe62c82af036e786411b6',
    'redirect' => 'http://localhost/blog/public/index.php/callback',
],
    
    'google' => [
    'client_id' => '940373802293-4ef821kn9enimrmo1tralsh1ma05bhj3.apps.googleusercontent.com 
',
    'client_secret' => 'BvI5vHjws8By8jqWVIzhII3h',
    'redirect' => 'http://localhost:8000/callback/google',
]
,
    'paypal' => [
        'client_id' => 'AWcyVLhqkD99JrcyfZk4ANbt7mfpcvN0QXCGVwnBpraWF2bHMhhJLKsekViqffcQDCjgTu1zRh3LiQa8',
        'secret' => 'EGOl3Fd19Z8a3o3r6yQPeavhHTDC1M27r2TdAW0E38W7LwtljDU6XJfHYhNYhvf6VNC2PMEHEGHL8EsH'
    ],

];
