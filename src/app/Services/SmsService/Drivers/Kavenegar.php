<?php

namespace App\Services\SmsService\Drivers;

use App\Services\SmsService\Concerns\HasApiAuth;
use App\Services\SmsService\Contracts\ApiAuth;
use App\Services\SmsService\DriverAbstract;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Kavenegar extends DriverAbstract implements ApiAuth
{
    use HasApiAuth;

    public function getBaseUrl(): ?string
    {
        return 'https://api.kavenegar.com/v1/' . self::getApiKey() . '/';
    }

    public function send(): PromiseInterface|Response
    {
        return Http::baseUrl($this->getBaseUrl())
            ->get(
                '/sms/send.json',
                [
                    'receptor' => $this->sender->getMobile(),
                    'message' => $this->sender->getMessage(),
                    'sender' => $this->getConfig('sender')
                ]
            )->throw();
    }
}
