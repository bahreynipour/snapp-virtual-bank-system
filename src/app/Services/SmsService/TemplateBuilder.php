<?php

namespace App\Services\SmsService;

use App\Services\SmsService\Contracts\Lookup;
use App\Services\SmsService\Exceptions\TemplateParametersOutOfRangeException;
use Illuminate\Support\Collection;

class TemplateBuilder
{
    protected Collection $parameters;

    protected string $name;

    public function __construct(protected Lookup $driver){
        $this->parameters = collect();
    }


    public function name( string $name ): static
    {
        $this->name = $name;

        return $this;
    }

    public function put(int|string $number, string $value): static
    {
        throw_if(
            $this->parameters->count() >= $this->driver->getParametersMaxCount(),
            TemplateParametersOutOfRangeException::class
        );

        $this->parameters->put(
            ($this->driver->getParametersKey() ?? '') . $number,
            $value
        );

        return $this;
    }

    public function toArray(): array
    {
        return $this->parameters->toArray();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function toJson(): string
    {
        return $this->parameters->toJson();
    }
}
