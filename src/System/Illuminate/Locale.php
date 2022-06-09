<?php declare(strict_types=1);

namespace System\Illuminate;

use Illuminate\Foundation\Application;

final class Locale
{
    public function __construct(
        private readonly Application $app
    ) {
    }

    public function current(): string
    {
        return $this->app->getLocale();
    }

    public function fallback(): string
    {
        return $this->app->make('config')['app.fallback_locale'];
    }

    public function set(string $locale): void
    {
        $this->app->setLocale($locale);
    }

    public function dir(): string
    {
        return $this->getConfiguredSupportedLocales()[$this->current()]['dir'];
    }

    public function nameFor(string $locale): string
    {
        return $this->getConfiguredSupportedLocales()[$locale]['name'];
    }

    public function supported(): array
    {
        return array_keys($this->getConfiguredSupportedLocales());
    }

    public function isSupported(?string $locale = null): bool
    {
        return in_array($locale, $this->supported(), true);
    }

    public function getConfiguredSupportedLocales(): array
    {
        return $this->app->make('config')['app.supported_locales'];
    }
}
