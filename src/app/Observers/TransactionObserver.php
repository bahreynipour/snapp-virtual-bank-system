<?php

namespace App\Observers;

use App\Models\Transaction;
use Throwable;

class TransactionObserver
{


    public function saved(Transaction $transaction): void
    {
        $transaction->account->recalculate();
    }

    /**
     * Handle the Transaction "creating" event.
     * @throws Throwable
     */
    public function creating(Transaction $transaction): void
    {
        if($transaction->isWithdraw()) {
            $transaction->amount = $transaction->amount->negative();
        }
    }


    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }
}
