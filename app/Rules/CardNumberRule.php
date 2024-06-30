<?php

namespace App\Rules;

use App\Support\Card;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CardNumberRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Card::isValid($value)){
            $fail('The :attribute field must be a valid card number.');
        }
    }
}
