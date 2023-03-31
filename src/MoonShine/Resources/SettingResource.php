<?php

namespace VI\LaravelSiteSettings\MoonShine\Resources;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Leeto\MoonShine\Actions\ExportAction;
use Leeto\MoonShine\Decorations\Block;
use Leeto\MoonShine\Fields\BelongsTo;
use Leeto\MoonShine\Fields\ID;
use Leeto\MoonShine\Fields\NoInput;
use Leeto\MoonShine\Fields\Text;
use Leeto\MoonShine\Fields\Textarea;
use Leeto\MoonShine\Resources\Resource;
use VI\LaravelSiteSettings\Models\Setting;


class SettingResource extends Resource
{
    public static string $model = Setting::class;

    public static string $title = 'Settings';

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

                BelongsTo::make(
                    'Group',
                    'settingGroup',
                    new SettingGroupResource()
                )
                    ->nullable()
                    ->sortable()
                    ->showOnExport(),

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

                Textarea::make('Value', 'value')->nullable()->sortable()
                    ->showOnExport(),

                NoInput::make('Created at', 'created_at',
                    fn(Setting $item) => $item->created_at->isoFormat('lll'))
                    ->sortable()
                    ->hideOnForm()
                    ->showOnExport(),

                NoInput::make('Updated at', 'updated_at',
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
        return parent::query()->with('settingGroup');
    }
}
