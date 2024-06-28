<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Collection::make($this->macros())
            ->reject(fn ($class, $macro) => Str::hasMacro($macro))
            ->each(fn ($class, $macro) => Str::macro($macro, app($class)()));
    }

    private function macros(): array
    {
        return [
            'normalizeNumbers' => \App\Macros\Str\NormalizeNumbers::class,
            'isDigits' => \App\Macros\Str\isDigits::class,
        ];
    }
}
