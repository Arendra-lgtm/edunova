<?php

namespace App\Filament\Resources\SchoolClasses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Unique;

class SchoolClassForm
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
                Select::make('level')
                    ->label('Level')
                    ->options([
                        'X' => 'X',
                        'XI' => 'XI',
                        'XII' => 'XII',
                    ])
                    ->native(false)
                    ->required(),
                Select::make('major')
                    ->label('Major')
                    ->options([
                         'RPL' => 'RPL',
                         'TKJ' => 'TKJ',
                         'DKV' => 'DKV',
                         'TKP' => 'TKP',
                         'SIJA' => 'SIJA',
                         'TOI' => 'TOI',
                    ])
                    ->searchable()
                    ->native(false)
                    ->required(),
                TextInput::make('name')
                    ->label('Class Number')
                    ->numeric()
                    ->minValue(1)
                    ->required()
                    ->unique(
                         ignoreRecord: true,
                         modifyRuleUsing: function (Unique $rule, callable $get) {
                            return $rule->where('academic_year_id', $get('academic_year_id'))
                    ->where('level', $get('level'))
                    ->where('major', $get('major'));
                   }
                ),
                TextInput::make('capacity')
                    ->numeric()
                    ->default(36)
                    ->minValue(1)
                    ->maxValue(50)
                    ->required(),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
                    
            ]);
    }
}
