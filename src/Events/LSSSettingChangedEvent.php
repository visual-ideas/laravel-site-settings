<?php

namespace VI\LaravelSiteSettings\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use VI\LaravelSiteSettings\Models\Setting;

class LSSSettingChangedEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(public Setting $setting)
    {
        //
    }

}
