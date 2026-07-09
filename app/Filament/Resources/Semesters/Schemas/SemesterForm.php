<?php

namespace App\Filament\Resources\Semesters\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Unique;

class SemesterForm
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
        ->placeholder('Select Academic Year')
        ->required(),

    Select::make('name')
    ->label('Semester')
    ->options([
        'Ganjil' => 'Ganjil',
        'Genap' => 'Genap',
    ])
    ->placeholder('Select Semester')
    ->required()
    ->native(false)
    ->unique(
        ignoreRecord: true,
        modifyRuleUsing: fn (Unique $rule, callable $get) => $rule
            ->where('academic_year_id', $get('academic_year_id'))
    ),

    DatePicker::make('start_date')
        ->label('Start Date')
        ->native(false)
        ->required()
        ->beforeOrEqual('end_date'),

    DatePicker::make('end_date')
        ->label('End Date')
        ->native(false)
        ->required()
        ->afterOrEqual('start_date'),

    Toggle::make('is_active')
    ->label('Active Semester')
    ->default(false)
    ->inline(false),

]);
    }
}
