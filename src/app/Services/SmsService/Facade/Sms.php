<?php

namespace App\Services\SmsService\Facade;

use Closure;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Facade;
use Illuminate\Http\Client\Response;

/**
 * @method static PromiseInterface|Response send(string $number, string|Closure $message);
 */
class Sms extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'sms.manager';
    }
}
