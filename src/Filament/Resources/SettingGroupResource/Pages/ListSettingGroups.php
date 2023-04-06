<?php

namespace VI\LaravelSiteSettings\Filament\Resources\SettingGroupResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use VI\LaravelSiteSettings\Filament\Resources\SettingGroupResource;

class ListSettingGroups extends ListRecords
{
    protected static string $resource = SettingGroupResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
