<?php

namespace App\Services\SmsService;

use App\Services\SmsService\Contracts\ApiAuth;
use App\Services\SmsService\Contracts\BasicAuth;
use App\Services\SmsService\Contracts\DriverContract;
use App\Services\SmsService\Contracts\Lookup;
use App\Services\SmsService\Exceptions\NotFoundApiKeyException;
use App\Services\SmsService\Exceptions\NotFoundBaseUrl;
use App\Services\SmsService\Exceptions\NotFoundBasicAuthException;
use App\Services\SmsService\Exceptions\NotFoundLookupBuilderMethodsException;
use Throwable;

class DriverValidator
{
    public function __construct(private DriverContract $driver)
    {
        $this->validateBaseUrl();
        $this->validateAuth();
        $this->validateLookup();
    }

    /**
     * @throws Throwable
     */
    protected function validateBaseUrl(): void
    {
        throw_if(
            empty($this->driver->getBaseUrl()),
            NotFoundBaseUrl::class
        );
    }

    /**
     * @throws Throwable
     */
    protected function validateAuth(): void
    {
        throw_if(
            $this->driver instanceof ApiAuth && !$this->driver->getApiKey(),
            NotFoundApiKeyException::class
        );

        throw_if(
            $this->driver instanceof BasicAuth
            && !$this->driver->getUsername()
            && !$this->driver->getPassword(),
            NotFoundBasicAuthException::class
        );
    }

    /**
     * @throws Throwable
     */
    protected function validateLookup(): void
    {
        throw_if(
            $this->driver instanceof Lookup
            && empty($this->driver->getTemplateKey())
            && empty($this->driver->getParametersMaxCount()),
            NotFoundLookupBuilderMethodsException::class
        );
    }
}
