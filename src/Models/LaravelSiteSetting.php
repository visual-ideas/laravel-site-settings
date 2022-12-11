<?php

namespace VI\LaravelSiteSettings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaravelSiteSetting extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'laravel_site_setting_group_id',
        'slug',
        'name',
        'value',
    ];

    public function laravelSiteSettingGroup(): BelongsTo
    {
        return $this->belongsTo(LaravelSiteSettingGroup::class);
    }

    public function group(): BelongsTo
    {
        return $this->laravelSiteSettingGroup();
    }

    public function getNameHumanAttribute(): string
    {

        $string = $this->slug;

        if (!empty($this->name)) {
            return $string . ' (' . $this->name . ')';
        }

        return $string;
    }
}