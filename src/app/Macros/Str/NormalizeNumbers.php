<?php

namespace App\Macros\Str;

use Closure;

/**
 * Normalize string's digits and convert persian and arabic digits to english digits
 */
class NormalizeNumbers
{
    public function __invoke(): Closure
    {
        return function ($value) {
            return str_replace(
                ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'],
                range(0, 9),
                str_replace(
                    ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'],
                    range(0, 9),
                    $value
                )
            );
        };
    }
}
