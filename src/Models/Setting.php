<?php

namespace VI\LaravelSiteSettings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Setting extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'setting_group_id',
        'slug',
        'hint',
        'value',
    ];

    public function settingGroup(): BelongsTo
    {
        return $this->belongsTo(SettingGroup::class);
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