<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Concerns\HasMetaColumn;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Services\TransactionService\Contracts\Sourceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transfer extends Model implements Sourceable
{
    use HasFactory,
        HasMetaColumn;

    protected $fillable = [
        'driver',
    ];

    protected $casts = [
        'meta' => 'json',
    ];

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    public function transaction(): MorphOne
    {
        return $this->morphOne(Transaction::class, 'source');
    }

    public function from(): MorphTo
    {
        return $this->morphTo();
    }

    public function to(): MorphTo
    {
        return $this->morphTo();
    }
}
