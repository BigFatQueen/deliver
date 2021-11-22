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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
'firebase' => [
    'api_key' => 'AIzaSyBVHlZ-7hKSmTXi1shjyqtP3pfh-wVS328',
    'auth_domain' => 'deliveryprj-8176e.firebaseapp.com',
    'database_url' => 'https://deliveryprj-8176e-default-rtdb.firebaseio.com',
    'project_id' => 'deliveryprj-8176e',
    'storage_bucket' => 'deliveryprj-8176e.appspot.com',
    'messaging_sender_id' => '144627415309',
    'app_id' => '1:144627415309:web:59d5b920329fa9aa19d844',
    'measurement_id' => 'G-56F3E2Z4WG',
],

];
