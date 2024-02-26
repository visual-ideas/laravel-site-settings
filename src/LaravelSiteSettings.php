<?php

namespace VI\LaravelSiteSettings;

use Illuminate\Contracts\Config\Repository as ConfigContract;
use Illuminate\Support\Arr;
use VI\LaravelSiteSettings\Models\Setting;
use VI\LaravelSiteSettings\Models\SettingGroup;

class LaravelSiteSettings implements ConfigContract
{

    protected array $items = [];

    public function __construct()
    {

        if (cache()->has(config('laravelsitesettings.cache_key'))) {
            $this->items = cache()->get(config('laravelsitesettings.cache_key'));
            return;
        }

        try {
            $withGroup = SettingGroup::all()
                ->load('settings')
                ->keyBy('slug')
                ->map(function ($group) {
                    return $group->settings->pluck('value', 'slug');
                })
                ->toArray();
            $withoutGroup = Setting::whereNull('setting_group_id')->get()
                ->pluck('value', 'slug')
                ->toArray();

            $this->items = array_merge($withGroup, $withoutGroup); 
        } catch (\Throwable $e) {
            $this->items = [];
        }

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

        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $key => $value) {
            Arr::set($this->items, $key, $value);

            $this->saveToDB($key, $value);
        }

        //dd($key, $value);
    }

    /**
     * Prepend a value onto an array configuration value.
     *
     * @param string $key
     * @param mixed $value
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
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function push($key, $value): void
    {
        $array = $this->get($key, []);

        $array[] = $value;

        $this->set($key, $array);
    }

    protected function saveToDB($key, $value)
    {

        $keys = explode('.', $key);

        if (count($keys) > 2) {
            return;
        }

        if (count($keys) == 2) {
            $group = array_shift($keys);
            $group = SettingGroup::firstOrCreate(['slug' => $group])->id;
        }

        Setting::updateOrCreate([
            'setting_group_id' => $group ?? null,
            'slug'             => current($keys),
        ], [
            'value' => $value,
        ]);

    }

}