<?php

namespace App\Filament\Resources\SchoolSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SchoolSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
    TextInput::make('school_name')
        ->label('School Name')
        ->placeholder('SMK Negeri 1 Cibinong')
        ->required()
        ->maxLength(255),

    TextInput::make('principal_name')
        ->label('Principal Name')
        ->placeholder('Drs. Budi Santoso')
        ->maxLength(255),

    TextInput::make('email')
        ->label('School Email')
        ->email()
        ->placeholder('info@school.sch.id'),

    TextInput::make('phone')
        ->label('Phone Number')
        ->tel()
        ->placeholder('+62 812 3456 7890'),

    TextInput::make('website')
        ->label('Website')
        ->url()
        ->placeholder('https://school.sch.id'),

    Textarea::make('address')
        ->label('School Address')
        ->rows(3)
        ->columnSpanFull(),

    TextInput::make('logo')
        ->label('Logo'),

    TextInput::make('favicon')
        ->label('Favicon'),

    TextInput::make('timezone')
        ->label('Timezone')
        ->default('Asia/Jakarta')
        ->required(),

    TextInput::make('locale')
        ->label('Locale')
        ->default('id')
        ->required(),

            ]);
    }
}
