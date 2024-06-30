<?php

namespace App\Providers;

use App\Services\TransactionService\Contracts\TransactionCreatorContract;
use App\Services\TransactionService\TransactionCreator;
use App\Services\TransferService\Contracts\TransferCreatorContract;
use App\Services\TransferService\TransferCreator;
use Illuminate\Support\ServiceProvider;

class BankServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TransactionCreatorContract::class, function () {
            return new TransactionCreator();
        });

        $this->app->bind(TransferCreatorContract::class, function () {
            return new TransferCreator();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
