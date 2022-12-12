# Easy laravel cached settings

Easy laravel cached settings (stored in MYSQL) package with MoonShine Laravel Admin GUI

[![Latest Version on Packagist](https://img.shields.io/packagist/v/visual-ideas/laravel-site-settings.svg?style=flat-square)](https://packagist.org/packages/visual-ideas/laravel-site-settings)
[![Total Downloads](https://img.shields.io/packagist/dt/visual-ideas/laravel-site-settings.svg?style=flat-square)](https://packagist.org/packages/visual-ideas/laravel-site-settings)

## Installation

You can install the package via composer:

```bash
composer require visual-ideas/laravel-site-settings
```

You must run the migrations with:

```bash
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="VI\LaravelSiteSettings\LaravelSiteSettingsProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
    'cache_key' => env('LSS_CACHE_KEY','laravel_site_settings_data'),
];
```

## Usage

You can use this package as default laravel config() function!

```php
function settings($key = null, $default = null)
{
    if (is_null($key)) {
        return app('Settings')->all();
    }

    if (is_array($key)) {
        return app('Settings')->set($key);
    }

    return app('Settings')->get($key, $default);
}
```

or Blade directive @settings
```php
@settings('group.setting')
```

or as part of native Laravel config()
```php
@config('settings.group.setting')
```

For PHPStorm you can set this blade directive with [This instruction](https://www.jetbrains.com/help/phpstorm/blade-page.html) 

## Update settings

You can use models VI\LaravelSiteSettings\Models\SettingGroup and VI\LaravelSiteSettings\Models\Setting

or set settings values with the settings() function:
```php
settings(['group.setting' => 'Value']);
settings(['setting' => 'Value']);
```


## Usage with MoonShine Laravel Admin
Please see [MoonShine](https://moonshine.cutcode.ru/)

You can publish two [MoonShine Resources](https://moonshine.cutcode.ru/resources-index) with command:
```bash
php artisan vendor:publish --provider="VI\LaravelSiteSettings\LaravelSiteSettingsProvider" --tag="moonshine"
```
and use them in your MoonShine admin panel, like this:

```php
MenuGroup::make('Настройки', [
    MenuItem::make('Настройки', LaravelSiteSettingResource::class)->icon('app'),
    MenuItem::make('Группы настроек', LaravelSiteSettingGroupResource::class)->icon('app'),
])->icon('app'),
```

## Credits

- [Alex](https://github.com/alexvenga)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.


