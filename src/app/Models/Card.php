<?php

namespace App\Models;

use App\Casts\CardCast;
use App\Services\TransferService\Contracts\ConnectedToAccount;
use App\Services\TransferService\Contracts\IsTransferDriver;
use App\Services\TransferService\Contracts\TransferCreatorContract;
use App\Support\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model implements IsTransferDriver, ConnectedToAccount
{
    use HasFactory;

    protected $fillable = [
        'number',
        'is_locked',
    ];

    protected $casts = [
        'number' => CardCast::class
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function transferToCard(Card $card, null|int|float|Money $money = null)
    {
        return app(TransferCreatorContract::class)->from($this)
            ->to($card)
            ->driver('card-to-card')
            ->money($money);
    }

//    public function transactions(): HasMany
//    {
//        return $this->hasMany(Transaction::class);
//    }


}
