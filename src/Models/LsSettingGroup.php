<?php

namespace VI\LaravelSiteSettings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LsSettingGroup extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'slug',
        'name',
    ];

    public function settings(): HasMany
    {
        return $this->hasMany(LsSetting::class, 'ls_setting_group_id');
    }
}