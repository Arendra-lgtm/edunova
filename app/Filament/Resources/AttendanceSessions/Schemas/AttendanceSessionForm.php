<?php

namespace App\Filament\Resources\AttendanceSessions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AttendanceSessionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('schedule_id')
                    ->label('Schedule')
                    ->options(
                        \App\Models\Schedule::all()->mapWithKeys(function ($schedule) {
                            return [
                                $schedule->id => $schedule->full_schedule,
                            ];
                        })
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                DatePicker::make('attendance_date')
                    ->default(now())
                    ->required(),
                TextInput::make('meeting_number')
                    ->required()
                    ->numeric(),
                Toggle::make('is_closed')
                    ->label('Closed')
                    ->default(false),
            ]);
    }
}
