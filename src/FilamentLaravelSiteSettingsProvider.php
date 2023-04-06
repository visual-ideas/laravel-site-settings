<?php

namespace VI\LaravelSiteSettings;

use Filament\PluginServiceProvider;
use VI\LaravelSiteSettings\Filament\Resources\SettingGroupResource;
use VI\LaravelSiteSettings\Filament\Resources\SettingResource;

class FilamentLaravelSiteSettingsProvider extends PluginServiceProvider
{

    public static string $name = 'laravel-site-settings';

    protected array $resources = [
        SettingGroupResource::class,
        SettingResource::class,
    ];

}