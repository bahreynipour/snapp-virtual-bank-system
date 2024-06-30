<?php

namespace App\Services\SmsService\Drivers;

use App\Services\SmsService\Concerns\HasApiAuth;
use App\Services\SmsService\Concerns\HasLookup;
use App\Services\SmsService\Contracts\ApiAuth;
use App\Services\SmsService\Contracts\Lookup;
use App\Services\SmsService\DriverAbstract;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class KavenegarLookup extends DriverAbstract implements ApiAuth, Lookup
{
    use HasApiAuth,
        HasLookup;

    public static function getTemplateKey(): string
    {
        return 'template';
    }

    public static function getParametersKey(): string
    {
        return 'token';
    }

    public static function getTypeKey(): string
    {
        return 'type';
    }

    public static function getParametersMaxCount(): int
    {
        return 3;
    }

    public function getBaseUrl(): ?string
    {
        return 'https://api.kavenegar.com/v1/' . self::getApiKey() . '/';
    }

    public function send(): PromiseInterface|Response
    {
        return Http::baseUrl($this->getBaseUrl())
            ->get(
                '/verify/lookup.json',
                [
                    ...$this->sender->getMessage()->toArray(),
                    'receptor' => $this->sender->getMobile(),
                    self::getTemplateKey() => $this->sender->getMessage()->getName()
                ]
            )->throw();
    }
}
