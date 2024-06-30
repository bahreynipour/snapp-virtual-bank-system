<?php

namespace App\Enums;

use App\Concerns\ExtendedEnum;

enum TransactionType: string
{
    use ExtendedEnum;

    case DEPOSIT = 'deposit';

    case WITHDRAW = 'withdraw';
}
