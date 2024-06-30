<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Observers\TransactionObserver;
use App\Services\TransactionService\Contracts\Sourceable;
use App\Support\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

/**
 * @property Account $account
 * @property Money $amount
 * @property string $type
 * @property string $status
 */

#[ObservedBy([TransactionObserver::class])]
class Transaction extends Model implements Sourceable
{
    use HasFactory;

    protected $fillable = [
        'status',
        'type',
        'amount',
        'balance'
    ];

    protected $casts = [
        'amount' => MoneyCast::class,
        'balance' => MoneyCast::class,
        'type' => TransactionType::class,
        'status' => TransactionStatus::class,
        'completed_at' => 'datetime'
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    public function source(): MorphTo
    {
        return $this->morphTo();
    }

    public function hasStatus(string $status): bool
    {
        return $this->status === $status;
    }

    public function updateStatus(string $status): bool
    {
        $this->status = $status;

        return $this->save();
    }

    public function isDeposit(): bool
    {
        return $this->type->value === TransactionType::DEPOSIT->value;
    }

    public function isWithdraw(): bool
    {
        return $this->type->value === TransactionType::WITHDRAW->value;
    }
}
