<?php

namespace App\Services\TransferService\Drivers;

use App\Models\Card;
use App\Models\Transfer;
use App\Services\TransferService\Contracts\TransferCreatorContract;
use App\Support\Card as CardObject;
use App\Support\Money;

class CardToCard
{
    private TransferCreatorContract $transferCreator;

    private function __construct(string|Card|CardObject $card)
    {
        $this->transferCreator = app(TransferCreatorContract::class)->driver('card-to-card');

        $this->transferCreator->from($this->getCard($card));
    }

    private function getCard(string|Card|CardObject $card)
    {
        if($card instanceof CardObject) {
            $card = CardObject::fromString($card);
        }

        return !$card instanceof CardObject
            ? Card::whereNumber($card)->firstOrFail()
            : $card;
    }

    public static function from(string|Card|CardObject $card): static
    {
        return new static($card);
    }

    public function to(string|Card|CardObject $card): static
    {
        $this->transferCreator->to($this->getCard($card));

        return $this;
    }

    public function give(int|float|string|Money $money): Transfer
    {
        return $this->transferCreator
            ->money($money)
            ->make();
    }
}
