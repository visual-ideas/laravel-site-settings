<?php

namespace VI\LaravelSiteSettings\Observers;

use Illuminate\Database\Eloquent\Model;

class LSSObserver
{

    public function created(Model $model)
    {
        cache()->forget(config('laravelsitesettings.cache_key'));
    }


    public function updated(Model $model)
    {
        cache()->forget(config('laravelsitesettings.cache_key'));
    }


    public function deleted(Model $model)
    {
        cache()->forget(config('laravelsitesettings.cache_key'));
    }


    public function restored(Model $model)
    {
        cache()->forget(config('laravelsitesettings.cache_key'));
    }


    public function forceDeleted(Model $model)
    {
        cache()->forget(config('laravelsitesettings.cache_key'));
    }
}