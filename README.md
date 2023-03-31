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
For PHPStorm you can set this blade directive with [This instruction](https://www.jetbrains.com/help/phpstorm/blade-page.html)


or as part of native Laravel config()

```php
@config('settings.group.setting')
```

<b>Not working in console!</b>

## Update settings

You can use models VI\LaravelSiteSettings\Models\SettingGroup and VI\LaravelSiteSettings\Models\Setting

or set settings values with the settings() function:

```php
settings(['group.setting' => 'Value']);
settings(['setting' => 'Value']);
```

## Usage with MoonShine Laravel Admin

Please see [MoonShine](https://moonshine.cutcode.ru/)

You can use settings in your MoonShine admin panel, like this:

```php
MenuGroup::make('Settings', [
    MenuItem::make(
        'Setting groups',
        new \VI\LaravelSiteSettings\MoonShine\Resources\SettingGroupResource(),
        'heroicons.outline.wrench-screwdriver'
    ),
    MenuItem::make(
        'Settings',
        new \VI\LaravelSiteSettings\MoonShine\Resources\SettingResource(),
        'heroicons.outline.wrench'
    ),
], 'heroicons.outline.cog-8-tooth'),
```

## Seeding settings

I recommend saving the settings in the seeders using the [orangehill/iseed](https://github.com/orangehill/iseed) package:

```bash
php artisan iseed setting_groups,settings
```

But you can use seeder or migration to set your settings

```php
settings([
    ['group.setting1' => 'Value1'],
    ['group.setting2' => 'Value2'],
    ['group.setting3' => 'Value3'],
    ['setting1' => 'Value4'],
    ['setting2' => 'Value5'],
    ['setting3' => 'Value6'],
    ['setting4' => 'Value7'],
    ['setting5' => 'Value8']
]);
```

## Credits

- [Alex](https://github.com/alexvenga)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.


