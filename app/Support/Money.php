<?php

namespace App\Support;

use App\Exceptions\InvalidMoneyException;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Throwable;

final readonly class Money
{
    /**
     * @throws Throwable
     */
    private function __construct(private string|int|float $amount)
    {
        throw_if(
            !is_numeric($this->amount),
            InvalidArgumentException::class
        );
    }

    /**
     * build Money Object
     * This object accepts persian and arabic digits by normalizing them.
     *
     * @throws Throwable
     */
    public static function forge(string|int|float $amount): Money
    {
        return new self(Str::normalizeNumbers($amount));
    }

    /**
     * @throws Throwable
     */
    private function ensureAmount(string|int|float|Money $amount): float|int|string
    {
        return $amount instanceof Money
            ? $amount->getAmount()
            : Money::forge($amount)->getAmount();
    }

    public function __toString(): string
    {
        return $this->getAmount();
    }

    public function getAmount(): int|float|string
    {
        return $this->amount;
    }

    /**
     * This money amount plus input amount
     *
     * @throws Throwable
     */
    public function plus(string|int|float|Money $amount): Money
    {
        return new self($this->getAmount() + $this->ensureAmount($amount));
    }

    /**
     * This money amount minus input amount
     *
     * @throws Throwable
     */
    public function minus(string|int|float|Money $amount): Money
    {
        return new self($this->getAmount() - $this->ensureAmount($amount));
    }

    /**
     * Make the money negative
     *
     * @throws Throwable
     */
    public function negative(): Money
    {
        return new self( - $this->getAmount());
    }

    /**
     * Check if this money amount is lower than input amount
     *
     * @throws Throwable
     */
    public function isLowerThan(string|int|float|Money $amount): bool
    {
        return $this->getAmount() < $this->ensureAmount($amount);
    }

    /**
     * Check if this money amount is greater than input amount
     *
     * @throws Throwable
     */
    public function isGreaterThan(string|int|float|Money $amount): bool
    {
        return $this->getAmount() > $this->ensureAmount($amount);
    }

    /**
     * Check if this money amount equals to input amount
     *
     * @throws Throwable
     */
    public function isEqualTo(string|int|float|Money $amount): bool
    {
        return $this->getAmount() === $this->ensureAmount($amount);
    }
}
