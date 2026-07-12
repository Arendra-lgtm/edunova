<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('academic_year_id')
                    ->label('Academic Year')
                    ->relationship('academicYear', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('school_class_id')
                    ->label('School Class')
                    ->relationship('schoolClass', 'name')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('nis')
                    ->label('NIS')
                    ->placeholder('Ex: 240001')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(20),
                TextInput::make('nisn')
                    ->label('NISN')
                    ->placeholder('Ex: 0056789123')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(20),
                TextInput::make('name')
                    ->label('Student Name')
                    ->placeholder('Ex: Andi Pratama')
                    ->required()
                    ->maxLength(255),
                Select::make('gender')
                    ->options([
                        'Laki-laki' => 'Laki laki', 
                        'Perempuan' => 'Perempuan',
                    ]) 
                    ->native(false)
                    ->required(),
                DatePicker::make('birth_date')
                    ->label('Birth Date')
                    ->native(false),
                Textarea::make('address')
                    ->label('Address')
                    ->rows(3)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Active Student')
                    ->default(true),
            ]);
    }
}
