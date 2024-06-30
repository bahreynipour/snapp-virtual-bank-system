<?php

namespace App\Macros\Str;

use Closure;
use Illuminate\Support\Str;

/**
 * Check if the string contains only digits characters
 * if $length argument provided, it checks the digits length to be equal with $length
 */
class isDigits
{
    public function __invoke(): Closure
    {
        return function (string $value, ?int $length = null) {
            return Str::of($value)->isMatch($length ? "/\A\d{{$length}}\z/" : "/^[0-9]+$/");
        };
    }
}
