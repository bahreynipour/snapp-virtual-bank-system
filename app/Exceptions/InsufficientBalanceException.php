<?php

namespace App\Exceptions;

use App\Models\Account;
use Exception;

class InsufficientBalanceException extends Exception
{
    public static string $ErrorCode = 'INSUFFICIENT_BALANCE';

    public function __construct(Account $account)
    {
        parent::__construct(
            "The account [{$account->number}] does not have enough balance."
        );
    }
}
