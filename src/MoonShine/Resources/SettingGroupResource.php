<?php

namespace VI\LaravelSiteSettings\MoonShine\Resources;

use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Date;
use MoonShine\Fields\ID;
use MoonShine\Fields\NoInput;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use VI\LaravelSiteSettings\Models\SettingGroup;


class SettingGroupResource extends Resource
{
    public static string $model = SettingGroup::class;

    public static string $title = 'Settings groups';

    public string $titleField = 'slug';

    public static array $activeActions = ['create', 'show', 'edit'];

    public function title(): string
    {
        return trans('laravel-site-settings::ui.settings_groups');
    }

    public function fields(): array
    {
        return [
            Block::make(trans('laravel-site-settings::ui.main'), [
                ID::make()->sortable(),

                Text::make(trans('laravel-site-settings::ui.slug'), 'slug')
                    ->required()
                    ->sortable()
                    ->hint('a-z, 0-9, -, _')
                    ->showOnExport(),

                Text::make(trans('laravel-site-settings::ui.hint'), 'hint')
                    ->nullable()
                    ->sortable()
                    ->hint(trans('laravel-site-settings::ui.not_used'))
                    ->showOnExport(),

                NoInput::make(trans('laravel-site-settings::ui.created_at'), 'created_at',
                    fn(SettingGroup $item)=>$item->created_at->isoFormat('lll'))
                    ->sortable()
                    ->hideOnForm()
                    ->showOnExport(),

                NoInput::make(trans('laravel-site-settings::ui.updated_at'), 'updated_at',
                    fn(SettingGroup $item)=>$item->updated_at->isoFormat('lll'))
                    ->sortable()
                    ->hideOnForm()
                    ->showOnExport(),

                NoInput::make(trans('laravel-site-settings::ui.count_settings'), 'settings_count')
                    ->sortable()
                    ->hideOnForm()
                    ->hideOnDetail()
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
            'slug' => 'required|max:190|regex:/^([a-z0-9\-\_]+)$/i|unique:setting_groups,slug,' . $item->getKey(),
            'hint' => 'nullable|max:190',
        ];
    }

    public function search(): array
    {
        return ['id', 'slug', 'hint'];
    }

    public function filters(): array
    {
        return [
        ];
    }

    public function actions(): array
    {
        return [

        ];
    }

    public function query(): Builder
    {
        return parent::query()->withCount('settings');
    }
}
