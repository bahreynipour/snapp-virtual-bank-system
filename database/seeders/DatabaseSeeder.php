<?php

namespace Database\Seeders;

use App\Enums\TransactionType;
use App\Models\Account;
use App\Models\Card;
use App\Models\Transaction;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Support\Money;
use Closure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Random\RandomException;
use Throwable;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory(5)
            ->create()
            ->each(function (User $user) {
                Account::factory(2)
                    ->create(['user_id' => $user->id])
                    ->each(function (Account $account) {
                        Card::factory(2)
                            ->create(['account_id' => $account->id])
                            ->each(function (Card $card) {

                            });
                    });
            });
    }

    /**
     * @throws Throwable
     * @throws RandomException
     */
    protected function createTransactions(Card $card)
    {
        Transaction::factory(100)
            ->create([
                'card_id' => $card->id,
                'type' => TransactionType::DEPOSIT->value,
                'balance' => $card->account->refresh()->balance->decrease($amount),
                'status' => TransactionStatus::DONE,
                'track_id' => Str::uuid()->toString(),
                'done_at' => now()->subMinutes(random_int(1, 20)),
            ])
            ->each(fn(Transaction $transaction) => $card->account()->update([
                'balance' => $card->account->refresh()->balance->decrease($transaction->amount)->getAmount()
            ]))
            ->each(fn(Transaction $transaction) => Transaction::factory(1)
                ->create([
                    'card_id' => $destinationCard = $destinationCards[random_int(0, 4)],
                    'amount' => $transaction->amount->decrease($cardToCardFee),
                    'balance' => $destinationCard->account->refresh()->balance->increase($transaction->amount->decrease($cardToCardFee)),
                    'is_deposit' => true,
                    'source_transaction_id' => $transaction->id,
                    'type' => TransactionType::CARD_TO_CARD,
                    'status' => TransactionStatus::DONE,
                    'track_id' => Str::uuid()->toString(),
                    'done_at' => $transaction->done_at,
                ])
                ->each(fn(Transaction $transaction) => $transaction->card->account()->update([
                    'balance' => $transaction->card->account->refresh()->balance->increase($transaction->amount)->getAmount()
                ]))
            )->each(fn(Transaction $transaction) => Fee::factory(1)
                ->create([
                    'transaction_id' => $transaction->id,
                    'amount' => $cardToCardFee
                ])
            );
    }
}
