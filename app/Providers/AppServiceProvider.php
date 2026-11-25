<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Uygulama servislerini kaydet.
     */
    public function register(): void
    {
        //
    }

    /**
     * Uygulama servislerini başlat.
     */
    public function boot(): void
    {
        if (config('demo.enabled') && $this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
