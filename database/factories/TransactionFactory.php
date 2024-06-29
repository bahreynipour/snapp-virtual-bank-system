<?php

namespace Database\Factories;

use App\Enums\TransactionProcessor;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Card;
use App\Support\Money;
use Illuminate\Database\Eloquent\Factories\Factory;
use Throwable;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Throwable
     */
    public function definition(): array
    {
        $isFailed = fake()->boolean(80);
        $processor = TransactionProcessor::CARD_TO_CARD->value;
        $amount = fake()->biasedNumberBetween(
            config("bank.transaction.processor.$processor.min", 10000),
            config("bank.transaction.processor.$processor.max", 500000000)
        );

        return [
            'card_id' => Card::factory(),
            'status' => !$isFailed ? TransactionStatus::SUCCESS : TransactionStatus::FAILED,
            'type' => fake()->randomElement(TransactionType::values()),
            'amount' => Money::forge($amount),
            'balance' => 0,
            'completed_at' => !$isFailed ? now() : null,
        ];
    }
}
