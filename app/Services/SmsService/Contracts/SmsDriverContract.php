<?php

namespace App\Services\SmsService\Contracts;

interface SmsDriverContract
{
    public function from(?string $from): static;

    public function to(string|array $toMobiles): static;

    public function message(string $message): static;
}
