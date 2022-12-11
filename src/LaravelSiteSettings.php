<?php

namespace VI\LaravelSiteSettings;

use Illuminate\Contracts\Config\Repository as ConfigContract;
use Illuminate\Support\Arr;
use VI\LaravelSiteSettings\Models\LaravelSiteSettingGroup;

class LaravelSiteSettings implements ConfigContract
{

    protected array $items;

    protected string $defaultGroupSlug;

    public function __construct()
    {

        $this->defaultGroupSlug = config('laravel_site_settings.default_group_slug');

        $this->items = cache()->rememberForever(config('laravel_site_settings.default_cache_key'), function () {
            return LaravelSiteSettingGroup::all()
                ->load('settings')
                ->keyBy('slug')
                ->map(function ($group) {
                    return $group->settings->pluck('value', 'slug');
                })
                ->toArray();
        });

    }

    /**
     * Determine if the given configuration value exists.
     *
     * @param string $key
     * @return bool
     */
    public function has($key): bool
    {
        return Arr::has($this->items, $key);
    }

    /**
     * Get the specified configuration value.
     *
     * @param array|string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null): mixed
    {
        if (is_array($key)) {
            return $this->getMany($key);
        }

        return Arr::get($this->items, $key, $default);
    }

    /**
     * Get all of the configuration items for the application.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * Set a given configuration value.
     *
     * @param array|string $key
     * @param mixed $value
     * @return void
     */
    public function set($key, $value = null): void
    {

        // TODO Add save to database on set

        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $key => $value) {
            Arr::set($this->items, $key, $value);
        }
    }

    /**
     * Prepend a value onto an array configuration value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function prepend($key, $value): void
    {
        $array = $this->get($key, []);

        array_unshift($array, $value);

        $this->set($key, $array);
    }

    /**
     * Push a value onto an array configuration value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function push($key, $value): void
    {
        $array = $this->get($key, []);

        $array[] = $value;

        $this->set($key, $array);
    }

    /**
     * Get many configuration values.
     *
     * @param array $keys
     * @return array
     */
    public function getMany(array $keys): array
    {
        $config = [];

        foreach ($keys as $key => $default) {
            $config[$key] = Arr::get($this->items, $key, $default);
        }

        return $config;
    }

}