<?php

namespace App\Services\SmsService;

use App\Services\SmsService\Contracts\DriverContract;
use App\Services\SmsService\Exceptions\NotFoundConfigurationKeyException;
use Illuminate\Support\Str;

abstract class DriverAbstract implements DriverContract
{
    protected Sender $sender;

    public function __construct(){
        $this->sender = app('sms.sender');
    }

    public function getConfig(?string $config = null, mixed $default = null)
    {
        $key = static::getConfigurationKey();

        throw_if(
            !$configs = config("sms.drivers.{$key}"),
            NotFoundConfigurationKeyException::class
        );

        return $config
            ? config("sms.drivers.{$key}.{$config}", $default)
            : $configs;
    }

    public static function getConfigurationKey(): ?string
    {
        $key = Str::snake(
            (new \ReflectionClass(static::class))->getShortName()
            , '-'
        ) ?? null;

        throw_if(
            !$key,
            NotFoundConfigurationKeyException::class
        );

        return $key;
    }
}
