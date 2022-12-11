<?php

namespace VI\LaravelSiteSettings\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelSiteSettings extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'settings';
    }
}