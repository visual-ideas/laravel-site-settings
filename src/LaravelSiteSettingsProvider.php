<?php

namespace VI\LaravelSiteSettings;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use VI\LaravelSiteSettings\LaravelSiteSettings;
use VI\LaravelSiteSettings\Models\Setting;
use VI\LaravelSiteSettings\Models\SettingGroup;
use VI\LaravelSiteSettings\Observers\LSSObserver;

class LaravelSiteSettingsProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('settings', function ($app) {
            return new LaravelSiteSettings();
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laravelsitesettings');

        if (config('laravelsitesettings.filament')) {
            $this->app->register(FilamentLaravelSiteSettingsProvider::class);
        }
    }

    public function boot()
    {

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('laravelsitesettings.php'),
            ], 'config');

            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        } else {
            config(['settings' => app('settings')->all()]);
        }

        Blade::directive('settings', function ($expression) {
            return "<?php echo settings($expression); ?>";
        });

        Setting::observe(LSSObserver::class);
        SettingGroup::observe(LSSObserver::class);

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'laravel-site-settings');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/laravel-site-settings'),
        ]);

    }

}
