<?php

namespace App\Services\SmsService\Contracts;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

interface DriverContract
{
    public function getConfig(?string $config = null, mixed $default = null);

    public static function getConfigurationKey(): ?string;

    public function getBaseUrl(): ?string;

    public function send(): PromiseInterface|Response;
}
