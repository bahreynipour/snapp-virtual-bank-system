<?php

namespace App\Support;

use App\Exceptions\InvalidCardNumberException;
use Illuminate\Support\Str;
use Throwable;

final readonly class Card
{
    private function __construct(private readonly string $cardNumber){}

    /**
     * @throws Throwable
     */
    public static function fromString(string $cardNumber): Card
    {
        return new self(self::validate($cardNumber));
    }

    /**
     * Validate the card's number
     *
     * @throws Throwable
     */
    public static function validate(string $cardNumber): string
    {
        $cardNumber = Str::remove('-', Str::normalizeNumbers($cardNumber));

        throw_if(
            !Str::isDigits($cardNumber, 16),
            InvalidCardNumberException::class
        );

        $prepareForValidation = collect(str_split($cardNumber))
            ->map(function ($number, $position) {
                $number = ($position + 1) % 2 === 0 ? $number : $number * 2;
                return $number > 9 ? $number - 9 : $number;
            });

        $t = $prepareForValidation->sum();

        throw_if(
            $prepareForValidation->sum() % 10 !== 0,
            InvalidCardNumberException::class
        );

        return $cardNumber;
    }

    public function isValid(string $cardNumber): bool
    {
        try {
            self::validate($cardNumber);
            return true;
        } catch (Throwable $exception) {
            return false;
        }
    }

    public function toString(): string
    {
        return $this->cardNumber;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Format the card's number and add "-" between every 4 digits
     * @return string
     */
    public function formatted(): string
    {
        return Str::wordWrap($this->toString(), 4, '-', true);
    }

    /**
     * Mask the card number
     *
     * @return string
     */
    public function masked(): string
    {
        return Str::mask($this->toString(), '*', 4, 8);
    }

}
