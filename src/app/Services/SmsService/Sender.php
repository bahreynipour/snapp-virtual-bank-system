<?php

namespace App\Services\SmsService;

use App\Services\SmsService\Contracts\DriverContract;
use App\Services\SmsService\Contracts\Lookup;
use App\Services\SmsService\Exceptions\InvalidMessageTypeForDriverException;
use App\Services\SmsService\Exceptions\NotFoundDriverException;
use Closure;
use Throwable;

class Sender
{
    private DriverContract $driver;

    private string|TemplateBuilder $message;

    private string $mobile;

    public function driver(string|DriverContract $driver): static
    {
        if(!$driver instanceof DriverContract) {
            throw_if(
                !$driver = config("sms.drivers.{$driver}.class"),
                NotFoundDriverException::class
            );
        }

        $driver = app($driver);

        // make sure that this driver is safe!
        new DriverValidator($driver);

        $this->driver = $driver;

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function message(string|Closure $message): static
    {
        $isLookup = $this->driver instanceof Lookup;

        $this->message = $message instanceof Closure
            ? $message($isLookup ? new TemplateBuilder($this->driver) : '')
            : $message;

        throw_if(
            $isLookup && !$this->message instanceof TemplateBuilder,
            InvalidMessageTypeForDriverException::class
        );

        return $this;
    }

    public function to(string $mobile): static
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function getMessage(): TemplateBuilder|string
    {
        return $this->message;
    }

    public function send()
    {
        return $this->driver->send();
    }
}
