<?php

namespace VI\LaravelSiteSettings\Filament\Resources\SettingGroupResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use VI\LaravelSiteSettings\Filament\Resources\SettingGroupResource;

class EditSettingGroup extends EditRecord
{
    protected static string $resource = SettingGroupResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
