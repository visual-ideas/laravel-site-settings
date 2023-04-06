<?php

namespace VI\LaravelSiteSettings\Filament\Resources;

use App\Filament\Resources\SettingGroupResource\RelationManagers;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use VI\LaravelSiteSettings\Models\SettingGroup;

class SettingGroupResource extends Resource
{
    protected static ?string $model = SettingGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('hint')
                    ->nullable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->sortable(),
                TextColumn::make('slug')
                    ->sortable()
                    ->color('primary'),
                TextColumn::make('hint')
                    ->sortable()
                    ->color('secondary'),
                TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime()
                    ->color('secondary'),
                TextColumn::make('updated_at')->dateTime()->color('secondary')
                    ->sortable()
                    ->dateTime()
                    ->color('secondary'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \VI\LaravelSiteSettings\Filament\Resources\SettingGroupResource\Pages\ListSettingGroups::route('/'),
            'create' => \VI\LaravelSiteSettings\Filament\Resources\SettingGroupResource\Pages\CreateSettingGroup::route('/create'),
            'edit' => \VI\LaravelSiteSettings\Filament\Resources\SettingGroupResource\Pages\EditSettingGroup::route('/{record}/edit'),
        ];
    }
}
