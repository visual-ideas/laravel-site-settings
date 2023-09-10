<?php

namespace VI\LaravelSiteSettings\Observers;

use Illuminate\Database\Eloquent\Model;
use VI\LaravelSiteSettings\Events\LSSSettingChangedEvent;
use VI\LaravelSiteSettings\Events\LSSSettingGroupChangedEvent;
use VI\LaravelSiteSettings\Models\Setting;
use VI\LaravelSiteSettings\Models\SettingGroup;

class LSSObserver
{

    public function saved(Model $model)
    {
        cache()->forget(config('laravelsitesettings.cache_key'));

        if ($model instanceof SettingGroup) {
            LSSSettingGroupChangedEvent::dispatch($model);
        } elseif ($model instanceof Setting) {
            LSSSettingChangedEvent::dispatch($model);
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