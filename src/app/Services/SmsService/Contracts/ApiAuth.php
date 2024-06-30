<?php

namespace App\Services\SmsService\Contracts;

interface ApiAuth{
    public function getApiKey(): string;
}
