<?php

namespace VI\LaravelSiteSettings\Filament\Resources\SettingResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use VI\LaravelSiteSettings\Filament\Resources\SettingResource;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
