<?php


if (!function_exists('settings')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param array|string|null $key
     * @param mixed $default
     * @return mixed|\Illuminate\Config\Repository
     */
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
}