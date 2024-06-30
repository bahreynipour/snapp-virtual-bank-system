<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardToCardRequest;
use App\Services\TransferService\Drivers\CardToCard;
use Illuminate\Http\Request;
use Throwable;

class CardController extends Controller
{
    public function cardToCard(CardToCardRequest $request)
    {
        $args = [
            'status' => 'success',
        ];
        try {
            $transfer = CardToCard::from($request->input('from_card'))
                ->to($request->input('to_card'))
                ->give($request->input('amount'));

            $args['tracking_code'] = $transfer->transaction->uuid;

        } catch (Throwable $exception) {
            $args['status'] = 'error';
            $args['code'] = $exception::ERROR_CODE;
        }

        return response()->json($args);
    }

}
