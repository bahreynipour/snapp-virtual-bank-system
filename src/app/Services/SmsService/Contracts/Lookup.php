<?php

namespace App\Services\SmsService\Contracts;

use App\Services\SmsService\TemplateBuilder;

interface Lookup
{
    public static function getTemplateKey(): string;

    public static function getParametersKey(): ?string;

    public static function getParametersMaxCount(): int;

    public static function getTypeKey(): ?string;

    public function template(TemplateBuilder $template): static;
}
