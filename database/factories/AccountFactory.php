<?php

namespace Database\Factories;

use App\Models\User;
use App\Support\Money;
use Illuminate\Database\Eloquent\Factories\Factory;
use Throwable;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AccountFactory extends Factory
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
            'user_id' => User::factory(),
            'number' => fake()->unique()->numerify('############'),
            'balance' => Money::forge( fake()->biasedNumberBetween(0, 500000000)),
            'uuid' => fake()->uuid
        ];
    }
}
