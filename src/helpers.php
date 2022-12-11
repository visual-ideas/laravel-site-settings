<?php


if (!function_exists('lss_config')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param array|string|null $key
     * @param mixed $default
     * @return mixed|\Illuminate\Config\Repository
     */
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
}