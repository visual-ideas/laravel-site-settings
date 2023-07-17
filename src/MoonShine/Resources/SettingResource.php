<?php

namespace VI\LaravelSiteSettings\MoonShine\Resources;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use MoonShine\Decorations\Block;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\ID;
use MoonShine\Fields\NoInput;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Filters\BelongsToFilter;
use MoonShine\Resources\Resource;
use VI\LaravelSiteSettings\Models\Setting;


class SettingResource extends Resource
{
    public static string $model = Setting::class;

    public static string $title = 'Settings';

    public string $titleField = 'slug';

    public static array $activeActions = ['create', 'show', 'edit'];

    public function title(): string
    {
        return __('laravel-site-settings::ui.settings');
    }

    public function fields(): array
    {
        return [
            Block::make(__('laravel-site-settings::ui.main'), [
                ID::make()->sortable(),

                BelongsTo::make(
                    __('laravel-site-settings::ui.group'),
                    'settingGroup',
                    new SettingGroupResource()
                )
                    ->nullable()
                    ->sortable()
                    ->showOnExport(),

                Text::make(__('laravel-site-settings::ui.slug'), 'slug')
                    ->required()
                    ->sortable()
                    ->hint('a-z, 0-9, -, _')
                    ->showOnExport(),

                Text::make(__('laravel-site-settings::ui.hint'), 'hint')
                    ->nullable()
                    ->sortable()
                    ->hint(__('laravel-site-settings::ui.not_used'))
                    ->showOnExport(),

                Textarea::make(__('laravel-site-settings::ui.value'), 'value')->nullable()->sortable()
                    ->showOnExport(),

                NoInput::make(__('laravel-site-settings::ui.created_at'), 'created_at',
                    fn(Setting $item) => $item->created_at->isoFormat('lll'))
                    ->sortable()
                    ->hideOnForm()
                    ->showOnExport(),

                NoInput::make(__('laravel-site-settings::ui.updated_at'), 'updated_at',
                    fn(Setting $item) => $item->updated_at->isoFormat('lll'))
                    ->sortable()
                    ->hideOnForm()
                    ->showOnExport(),


            ]),
        ];
    }

    public function components(): array
    {
        return [
        ];
    }

    public function rules($item): array
    {
        return [
            'setting_group_id' => 'nullable|exists:setting_groups,id',
            'slug' => [
                'required',
                'max:190',
                'regex:/^([a-z0-9\-\_]+)$/i',
                'unique:setting_groups,slug',
                Rule::unique('settings', 'slug')->where(function ($query) use ($item) {
                    return $query->where('id', '!=', $item->getKey())
                        ->where('setting_group_id', $item->setting_group_id);
                }),
            ],
            'hint' => 'nullable|max:190',
            'value' => 'nullable|string',
        ];
    }

    public function search(): array
    {
        return ['id', 'slug', 'hint', 'value'];
    }

    public function filters(): array
    {
        return [
            BelongsToFilter::make('Group', 'settingGroup'),
        ];
    }

    public function actions(): array
    {
        return [

        ];
    }

    public function query(): Builder
    {
        return parent::query()->with('settingGroup');
    }
}
