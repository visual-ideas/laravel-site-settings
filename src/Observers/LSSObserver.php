<?php

namespace VI\LaravelSiteSettings\Observers;

use Illuminate\Database\Eloquent\Model;
use VI\LaravelSiteSettings\Models\Setting;
use VI\LaravelSiteSettings\Models\SettingGroup;

class LSSObserver
{

    public function saved(Model $model)
    {
        cache()->forget(config('laravelsitesettings.cache_key'));

        if ($model instanceof SettingGroup) {
            dd('group settings');
        } elseif ($model instanceof Setting) {
            dd('instance settings');
        }
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