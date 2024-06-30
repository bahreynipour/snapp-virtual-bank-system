<?php

namespace App\Services\SmsService\Concerns;

trait HasApiAuth {

    public function getApiKey(): string
    {
        return $this->getConfig('api_key');
    }

}
