<?php

namespace Database\Factories;

use App\Models\Account;
use App\Support\Card;
use Illuminate\Database\Eloquent\Factories\Factory;
use Throwable;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Throwable
     */
    public function definition(): array
    {
        return [
            'account_id' => Account::factory(),
            'number' => Card::fromString(fake()->unique()->creditCardNumber('Visa'))
        ];
    }
}
