<?php

namespace VI\LaravelSiteSettings;

class LaravelSiteSettings
{
    protected array $settings;

    public function __construct()
    {
        dump('constr');
    }

    public function get(string $group, string $setting)
    {
        dd($group, $setting);
    }
}