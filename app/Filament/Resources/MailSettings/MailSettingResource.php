<?php

namespace App\Filament\Resources\MailSettings;

use App\Filament\Resources\MailSettings\Pages\CreateMailSetting;
use App\Filament\Resources\MailSettings\Pages\EditMailSetting;
use App\Filament\Resources\MailSettings\Pages\ListMailSettings;
use App\Filament\Resources\MailSettings\Schemas\MailSettingForm;
use App\Filament\Resources\MailSettings\Tables\MailSettingsTable;
use App\Models\MailSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MailSettingResource extends Resource
{
    protected static ?string $model = MailSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::EnvelopeOpen;

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return MailSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MailSettingsTable::configure($table);
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
            'index' => ListMailSettings::route('/'),
            'create' => CreateMailSetting::route('/create'),
            'edit' => EditMailSetting::route('/{record}/edit'),
        ];
    }
}
