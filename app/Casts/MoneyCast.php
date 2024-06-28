<?php

namespace App\Casts;

use App\Support\Money;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use Throwable;

class MoneyCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param array<string, mixed> $attributes
     * @throws Throwable
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return Money::forge($value ?? 0);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param array<string, mixed> $attributes
     * @throws Throwable
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        throw_if(
            !$value instanceof Money,
            InvalidArgumentException::class,
            sprintf('Invalid data provided for %s::$%s', get_class($model), $key)
        );

        return $value;
    }
}
