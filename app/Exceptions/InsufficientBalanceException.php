<?php

namespace App\Exceptions;

use App\Models\Account;
use Exception;

class InsufficientBalanceException extends Exception
{
    public const ERROR_CODE = 'INSUFFICIENT_BALANCE';

    public function __construct(Account $account)
    {
        parent::__construct(
            "The account [{$account->number}] does not have enough balance."
        );
    }
}
