<?php

namespace VI\LaravelSiteSettings\Filament\Resources\SettingResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use VI\LaravelSiteSettings\Filament\Resources\SettingResource;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
