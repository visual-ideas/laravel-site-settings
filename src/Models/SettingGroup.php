<?php

namespace VI\LaravelSiteSettings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SettingGroup extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'slug',
        'name',
    ];

    public function settings(): HasMany
    {
        return $this->hasMany(Setting::class);
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