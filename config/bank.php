<?php

return [
    'transfer' => [
        'card-to-card' => [
            'min' => 10000,
            'max' => 500000000
        ]
    ],

    'balance' => [
        'calculation' => [
            'statuses' => [
                \App\Enums\TransactionStatus::INITIALIZED->value,
                \App\Enums\TransactionStatus::SUCCESS->value,
                \App\Enums\TransactionStatus::ON_HOLD->value,
                \App\Enums\TransactionStatus::AWAITING_APPROVAL->value
            ],
        ],
    ],

    /**
     * Storage of the state of the balance of accounts.
     */
    'cache' => [
        'driver' => 'array',
        'ttl' => 24 * 3600,
    ],

    /**
     * Lock system for dealing with race condition
     */
    'lock' => [
        'driver' => 'array',
        'seconds' => 1,
    ],
];
