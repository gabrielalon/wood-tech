<?php

namespace System\Illuminate\Providers;

use Illuminate\Support\ServiceProvider;
use System\Illuminate\Locale;

final class LocaleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Locale::class, function ($app) {
            return new Locale($app);
        });
    }
}
