<?php

namespace App\Rules;

use App\Support\Money;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CardToCardAmountRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $min_amount = config('bank.transfer.card-to-card.min', 10000);
        $max_amount = config('bank.transfer.card-to-card.max', 500000000);

        $translateParameters = [
            'min_amount' => $min_amount,
            'max_amount' => $max_amount,
        ];

        try {
            $amount = Money::forge($value);

            if($amount->isLowerThan($min_amount) || $amount->isGreaterThan($max_amount)) {
                $fail('The :attribute field must be in :min_amount and :max_amount range.')->translate($translateParameters);
            }
        } catch (\Throwable $exception) {
            $fail('The :attribute field must be in :min_amount and :max_amount range.')->translate($translateParameters);
        }
    }
}
