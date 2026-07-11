<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('employee_id')
                    ->label('Employee ID')
                    ->placeholder('TCH0001')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(30),
                TextInput::make('name')
                    ->label('Teacher Name')
                    ->placeholder('Budi Santoso')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->placeholder('budi@example.com')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->placeholder('081234567890')
                    ->maxLength(20),
                Select::make('gender')
                    ->label('Gender')
                    ->options([
                        'Laki-laki' => 'Laki laki', 
                        'Perempuan' => 'Perempuan'
                    ])
                    ->native(false)
                    ->required(),
                Textarea::make('address')
                    ->label('Address')
                    ->rows(3)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Active Teacher')
                    ->required(),
            ]);
    }
}
