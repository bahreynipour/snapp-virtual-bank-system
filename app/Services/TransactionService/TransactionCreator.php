<?php

namespace App\Services\TransactionService;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Exceptions\InsufficientBalanceException;
use App\Models\Account;
use App\Models\Transaction;
use App\Services\LockService\Concerns\Lockable;
use App\Services\LockService\TransactionLocker;
use App\Services\TransactionService\Contracts\Sourceable;
use App\Services\TransactionService\Contracts\TransactionCreatorContract;
use App\Support\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;
use Throwable;

class TransactionCreator implements TransactionCreatorContract
{
    use Lockable;

    protected Transaction $transaction;

    public function __construct()
    {
        $this->transaction = app(Transaction::class);

        $this->transaction->uuid = Str::uuid();

        $this->status(TransactionStatus::INITIALIZED->value);
    }

    public function make(): Transaction
    {
        $create = function () {
            $this->validate();

            $transaction = $this->transaction;

            $amount = $transaction->isWithdraw()
                ? $transaction->amount->negative()
                : $transaction->amount->positive();

            // make sure that we are inserting correct minus/plus to transactions
            $transaction->amount = $amount;

            $transaction->balance = $transaction->account->balance->plus($amount);

            if ($transaction->isWithdraw()) {
                $transaction->account->assertHaveBalance($this->transaction->amount);
            }

            $transaction->save();

            return $transaction;
        };

        $safelyTransaction = new TransactionLocker($create, $this->getLockRecord());

        return $safelyTransaction->setThrow(true)->run();
    }

    protected function getLockRecord(): Model|Builder|null
    {
        $transaction = $this->transaction;

        if (is_bool($this->lockRecord)) {
            return $this->lockRecord ? $transaction->account : null;
        }

        return $this->lockRecord ?? $transaction->account;
    }

    public function account(int|Account $account): static
    {
        $this->transaction->account()->associate($account);

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function amount(null|string|float|int|Money $amount): static
    {
        $this->transaction->amount = Money::forge($amount);

        return $this;
    }

    public function status(string $status): static
    {
        $this->transaction->status = $status;

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function deposit(null|string|float|int|Money $amount = null): static
    {
        $this->transaction->type = TransactionType::DEPOSIT->value;

        if ($amount) {
            $this->amount($amount);
        }

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function withdraw(null|string|float|int|Money $amount = null): static
    {
        $this->transaction->type = TransactionType::WITHDRAW->value;

        if ($amount) {
            $this->amount($amount);
        }

        return $this;
    }

    public function source(Sourceable $source): static
    {
        $this->transaction->source()->associate($source);

        return $this;
    }

    protected function validate(): void
    {

    }
}
