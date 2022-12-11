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
            return app('settings')->all();
        }

        if (is_array($key)) {
            return app('settings')->set($key);
        }

        return app('settings')->get($key, $default);
    }
}