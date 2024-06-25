<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->bindAppSettings();
    }

    public function bindAppSettings()
    {

        $this->app->singleton('settings', fn () => Setting::first());
        $this->app->singleton('logo', fn () => app('settings')?->logo);
        $this->app->singleton('favicon', fn () => app('settings')?->favicon);
        $this->app->singleton('name', fn () => app('settings')?->app_name);
        $this->app->bind('colors', fn () => Setting::first()?->colors);
        view()->composer('*', function ($view) {
            $this->app->bind('color-primary', function () {
                return app('settings')->getColor('primary');
            });
        });
    }
}
