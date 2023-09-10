<?php

namespace VI\LaravelSiteSettings\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use VI\LaravelSiteSettings\Models\Setting;
use VI\LaravelSiteSettings\Models\SettingGroup;

class LSSSettingGroupChangedEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(public Setting $setting)
    {
        //
    }

}
