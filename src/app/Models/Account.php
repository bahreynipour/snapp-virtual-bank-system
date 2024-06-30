<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Enums\TransactionStatus;
use App\Exceptions\InsufficientBalanceException;
use App\Services\TransactionService\Contracts\TransactionCreatorContract;
use App\Support\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Throwable;

/**
 * @property Money $balance
 */

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'uuid',
        'balance',
    ];

    protected $casts = [
        'balance' => MoneyCast::class,
        'meta' => 'json'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function deposit(float|int|string|Money $amount): TransactionCreatorContract
    {
        return app(TransactionCreatorContract::class)
            ->account($this)
            ->deposit($amount);
    }

    public function withdraw(float|int|string|Money $amount): TransactionCreatorContract
    {
        return app(TransactionCreatorContract::class)
            ->account($this)
            ->withdraw($amount);
    }

    public function recalculate(): bool
    {
        $statuses = config('bank.balance.calculation.statuses', [
            TransactionStatus::INITIALIZED->value,
            TransactionStatus::SUCCESS->value,
            TransactionStatus::ON_HOLD->value,
            TransactionStatus::AWAITING_APPROVAL->value,
        ]);

        $balance = $this->transactions()
            ->whereIn('status', $statuses)
            ->sum('amount');

        return $this->update([
            'balance' => Money::forge($balance ?? 0)
        ]);
    }

    /**
     * @throws InsufficientBalanceException|Throwable
     */
    public function assertHaveBalance(string $needs): void {

        $this->refresh();

        throw_if(
            !$this->hasEnoughBalance($needs),
            InsufficientBalanceException::class,
            $this
        );
    }

    /**
     * @throws Throwable
     */
    public function hasEnoughBalance(string|float|int|Money $needs): bool {
        return !$this->balance->isLowerThan(Money::forge($needs)->positive());
    }
}
