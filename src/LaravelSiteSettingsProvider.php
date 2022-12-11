<?php

namespace VI\LaravelSiteSettings;

use Illuminate\Support\ServiceProvider;

class LaravelSiteSettingsProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('LssConfig', function ($app) {
            return new LaravelSiteSettings();
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laravel_site_settings');
    }

    public function boot()
    {

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('laravel_site_settings.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../stubs/MoonShine/Resources/LaravelSiteSettingGroupResource.php.stub' => app_path('MoonShine/Resources/LaravelSiteSettingGroupResource.php'),
                __DIR__ . '/../stubs/MoonShine/Resources/LaravelSiteSettingResource.php.stub'      => app_path('MoonShine/Resources/LaravelSiteSettingResource.php'),
            ], 'moonshine');

        }

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

    }

}