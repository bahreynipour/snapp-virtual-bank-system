<?php

namespace App\Enums;

use App\Concerns\ExtendedEnum;

enum TransactionStatus: string
{
    use ExtendedEnum;

    case INITIALIZED = 'initialized';

    case SUCCESS = 'success';

    case ON_HOLD = 'on_hold';

    case CANCELED = 'canceled';
    case AWAITING_APPROVAL = 'awaiting_approval';

    case FAILED = 'failed';
}
