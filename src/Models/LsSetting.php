<?php

namespace VI\LaravelSiteSettings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LsSetting extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'ls_setting_group_id',
        'slug',
        'name',
        'value'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(LsSettingGroup::class, 'ls_setting_group_id');
    }
}