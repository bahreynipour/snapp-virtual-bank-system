<?php

namespace App\Services\TransactionService\Contracts;

use App\Models\Account;
use App\Models\Transaction;
use App\Support\Money;

interface TransactionCreatorContract
{
    public function make(): Transaction;

    public function account(int|Account $account): static;

    public function amount(null|string|float|int|Money $amount): static;

    public function status(string $status): static;

    public function deposit(null|string|float|int|Money $amount = null): static;

    public function withdraw(null|string|float|int|Money $amount = null): static;

    public function source(Sourceable $source): static;
}
