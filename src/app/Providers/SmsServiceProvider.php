<?php

namespace App\Providers;

use App\Services\SmsService\Sender;
use App\Services\SmsService\SmsManager;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('sms.sender', fn() => new Sender());

        $this->app->bind('sms.manager', function () {

            $sender = $this->app['sms.sender'];;

            $sender->driver(config('sms.default_driver'));

            return new SmsManager($sender);
        });
    }
}
