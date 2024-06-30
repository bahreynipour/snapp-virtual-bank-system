<?php

namespace App\Http\Requests;

use App\Rules\CardNumberRule;
use App\Rules\CardToCardAmountRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CardToCardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'from_card' => ['required', 'string', new CardNumberRule(), 'exists:cards,number'],
            'to_card' => ['required', 'string', 'different:from_card', new CardNumberRule(), 'exists:cards,number' ],
            'amount' => ['required', 'integer', new CardToCardAmountRule()]
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'from_card' => Str::normalizeNumbers($this->from_card),
            'to_card' => Str::normalizeNumbers($this->to_card),
            'amount' => Str::normalizeNumbers($this->amount)
        ]);
    }
}
