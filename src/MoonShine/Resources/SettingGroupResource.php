<?php

namespace VI\LaravelSiteSettings\MoonShine\Resources;

use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Actions\ExportAction;
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

    // TODO Add translation
    //public function title(): string
    //{
    //    return trans('moonshine::ui.resource.admins_title');
    //}

    public function fields(): array
    {
        return [
            Block::make('Main', [
                ID::make()->sortable(),

                Text::make('Slug', 'slug')
                    ->required()
                    ->sortable()
                    ->hint('a-z, 0-9, -, _')
                    ->showOnExport(),

                Text::make('Hint', 'hint')
                    ->nullable()
                    ->sortable()
                    ->hint('Не используется на сайте, только для удобства администрирования!')
                    ->showOnExport(),

                NoInput::make('Created at', 'created_at',
                    fn(SettingGroup $item)=>$item->created_at->isoFormat('lll'))
                    ->sortable()
                    ->hideOnForm()
                    ->showOnExport(),

                NoInput::make('Updated at', 'updated_at',
                    fn(SettingGroup $item)=>$item->updated_at->isoFormat('lll'))
                    ->sortable()
                    ->hideOnForm()
                    ->showOnExport(),

                NoInput::make('Count settings', 'settings_count')
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
            ExportAction::make(trans('moonshine::ui.export')),
        ];
    }

    public function query(): Builder
    {
        return parent::query()->withCount('settings');
    }
}
