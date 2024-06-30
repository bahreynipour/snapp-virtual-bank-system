<?php

namespace App\Services\TransferService;

use App\Concerns\Eventable;
use App\Models\Transfer;
use App\Services\LockService\Concerns\Lockable;
use App\Services\LockService\TransactionLocker;
use App\Services\TransactionService\Contracts\Sourceable;
use App\Services\TransferService\Contracts\ConnectedToAccount;
use App\Services\TransferService\Contracts\IsTransferDriver;
use App\Services\TransferService\Contracts\TransferCreatorContract;
use App\Support\Money;
use Illuminate\Support\Str;

class TransferCreator implements TransferCreatorContract
{
    use Lockable,
        Eventable;

    protected Transfer $transfer;

    protected ?Money $money = null;

    public function __construct()
    {
        $this->transfer = app(Transfer::class);

        $this->transfer->uuid = Str::uuid();
    }

    public function make(): Transfer
    {
        $create = function () {
            $this->validate();

            $transfer = $this->transfer;


            $this->fire('before', $transfer);

            $transfer->save();

            $withdrawCreator = $this->makeWithdraw($transfer);

            $depositCreator = $this->makeDeposit($withdrawCreator);

            $this->fire('after', [
                $transfer,
                $withdrawCreator,
                $depositCreator
            ]);

            return $transfer;
        };

        $safelyTransaction = new TransactionLocker($create);

        return $safelyTransaction
            ->setThrow(true)
            ->run();
    }

    public function makeWithdraw(Sourceable $source)
    {
        $from = $this->transfer?->from;
        return !$from instanceof ConnectedToAccount
            ? null
            : $from->account
                ->withdraw($this->money)
                ->source($source)
                ->make();

    }

    public function makeDeposit(Sourceable $source)
    {
        $to = $this->transfer?->to;
        return !$to instanceof ConnectedToAccount
            ? null
            : $to->account
                ->deposit($this->money)
                ->source($source)
                ->make();
    }

    public function from(IsTransferDriver $driver): static
    {
        $this->transfer->from()->associate($driver);

        return $this;
    }

    public function to(IsTransferDriver $driver): static
    {
        $this->transfer->to()->associate($driver);

        return $this;
    }

    public function meta(array|string $key, float|array|int|string|null $value = null): static
    {
        $this->transfer->updateMeta($key, $value);

        return $this;
    }

    public function driver(string $driver): static
    {
        $this->transfer->driver = $driver;

        return $this;
    }

    public function money(string|float|int|Money $money)
    {
        $this->money = Money::forge($money);

        return $this;
    }

    public function validate()
    {

    }
}
