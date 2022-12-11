<?php

namespace VI\LaravelSiteSettings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LaravelSiteSettingGroup extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'slug',
        'name',
    ];

    public function laravel_site_settings(): HasMany
    {
        return $this->hasMany(LaravelSiteSetting::class);
    }

    public function settings(): HasMany
    {
        return $this->laravel_site_settings();
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