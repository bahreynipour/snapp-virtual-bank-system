<?php

namespace App\Services\SmsService\Drivers;

use App\Services\SmsService\Concerns\HasApiAuth;
use App\Services\SmsService\Contracts\ApiAuth;
use App\Services\SmsService\DriverAbstract;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Ghasedak extends DriverAbstract implements ApiAuth
{
    use HasApiAuth;

    public function getBaseUrl(): ?string
    {
        return 'https://api.ghasedak.me/v2/';
    }

    public function send(): PromiseInterface|Response
    {
        return Http::asForm()->baseUrl($this->getBaseUrl())
            ->withHeader('apikey', self::getApiKey())
            ->post('sms/send/simple?' .
                http_build_query(
                    [
                        'receptor' => $this->sender->getMobile(),
                        'message' => $this->sender->getMessage(),
                    ]
                )
            )->throw();
    }
}
