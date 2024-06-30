<?php

return [

    'default_driver' => env('SMS_DRIVER', 'kavenegar'),

    'drivers' => [
        'kavenegar-lookup' => [
            'lookup' => true, # required
            'class' => \App\Services\SmsService\Drivers\KavenegarLookup::class, # required
            'api_key' => '', # required
            'global_pattern' => '00' # optional
        ],
        'kavenegar' => [
            'class' => \App\Services\SmsService\Drivers\Kavenegar::class, # required
            'api_key' => '', # required
            'global_pattern' => '00', # optional
            'sender' => '' # optional
        ],
    ]
];
