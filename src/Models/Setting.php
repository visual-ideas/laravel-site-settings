<?php

namespace VI\LaravelSiteSettings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $slug
 * @property string|null $hint
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $name_human attribute
 * @property-read int $settings_count
 */
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

        if (! empty($this->name)) {
            return $string.' ('.$this->name.')';
        }

        return $string;
    }
}
