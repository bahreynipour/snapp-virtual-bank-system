<?php

namespace App\Services\SmsService;


use App\Services\SmsService\Contracts\DriverContract;
use Closure;
use Throwable;

class SmsManager
{
    private Sender $sender;

    public function __construct()
    {
        $this->sender = app('sms.sender');
    }

    public function via(DriverContract $driver): static
    {
        $this->sender->driver($driver);

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function send(string $mobile, string|Closure $message)
    {
        return $this->to($mobile)
            ->message($message)
            ->send();
    }

    public function to(string $mobile): Sender
    {
        return $this->sender->to($mobile);
    }
}
