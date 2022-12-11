# Easy Laravel grouped settings (stored in MYSQL) package with MoonShine Laravel Admin GUI

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
    'default_cache_key' => env('LSS_CACHE_KEY','laravel_site_settings_data'),
];
```

## Usage

You can use this package as default laravel config() function!

```php
    function lss_config($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('LssConfig')->all();
        }

        if (is_array($key)) {
            return app('LssConfig')->set($key);
        }

        return app('LssConfig')->get($key, $default);
    }
```

## Usage with MoonShine Laravel Admin
Please see [MoonShine](https://moonshine.cutcode.ru/)

You can publish two [MoonShine Resources](https://moonshine.cutcode.ru/resources-index) with command:
```bash
php artisan vendor:publish --provider="VI\LaravelSiteSettings\LaravelSiteSettingsProvider" --tag="moonshine"
```
and use them in your MoonShine admin panel


## Credits

- [Alex](https://github.com/alexvenga)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.


