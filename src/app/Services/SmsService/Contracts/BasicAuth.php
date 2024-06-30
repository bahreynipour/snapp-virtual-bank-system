<?php

namespace App\Services\SmsService\Contracts;

interface BasicAuth{
    public function getUsername(): string;

    public function getPassword(): string;
}
