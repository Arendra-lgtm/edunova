<?php

namespace App\Filament\Resources\SchoolSettings;

use App\Filament\Resources\SchoolSettings\Pages\CreateSchoolSetting;
use App\Filament\Resources\SchoolSettings\Pages\EditSchoolSetting;
use App\Filament\Resources\SchoolSettings\Pages\ListSchoolSettings;
use App\Filament\Resources\SchoolSettings\Pages\ViewSchoolSetting;
use App\Filament\Resources\SchoolSettings\Schemas\SchoolSettingForm;
use App\Filament\Resources\SchoolSettings\Schemas\SchoolSettingInfolist;
use App\Filament\Resources\SchoolSettings\Tables\SchoolSettingsTable;
use App\Models\SchoolSetting;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SchoolSettingResource extends Resource
{
    protected static ?string $model = SchoolSetting::class;

    protected static string|null $navigationLabel = 'School Settings';

    protected static string|UnitEnum|null $navigationGroup = 'System';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $recordTitleAttribute = 'school_name';

    public static function form(Schema $schema): Schema
    {
        return SchoolSettingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SchoolSettingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchoolSettingsTable::configure($table);
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
            'index' => ListSchoolSettings::route('/'),
            'create' => CreateSchoolSetting::route('/create'),
            'view' => ViewSchoolSetting::route('/{record}'),
            'edit' => EditSchoolSetting::route('/{record}/edit'),
        ];
    }
}
