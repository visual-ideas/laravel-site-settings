<?php

namespace VI\LaravelSiteSettings;

use Illuminate\Support\ServiceProvider;

class LaravelSiteSettingsProvider extends ServiceProvider
{

    public function register()
    {
        //$this->mergeConfigFrom(__DIR__.'/../config/config.php', 'moonshine-site-settings');
    }

    public function boot()
    {

        if ($this->app->runningInConsole()) {

            //$this->publishes([
            //    __DIR__.'/../config/config.php' => config_path('laravel-site-settings.php'),
            //], 'config');
            // php artisan vendor:publish --provider="VI\LaravelSiteSettings\LaravelSiteSettingsProvider" --tag="config"

        }

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

    }

}