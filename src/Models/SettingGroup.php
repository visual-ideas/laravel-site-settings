<?php

namespace VI\LaravelSiteSettings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $slug
 * @property string|null $hint
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $name_human attribute
 * @property Setting[] $settings
 * @property-read int $settings_count
 */
class SettingGroup extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'slug',
        'hint',
    ];

    public function settings(): HasMany
    {
        return $this->hasMany(Setting::class);
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
