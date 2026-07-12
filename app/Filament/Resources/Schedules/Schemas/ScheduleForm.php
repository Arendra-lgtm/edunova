<?php

namespace App\Filament\Resources\Schedules\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Select::make('academic_year_id')
                    ->label('Academic Year')
                    ->relationship('academicYear', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('semester_id')
                    ->label('Semester')
                    ->relationship('semester', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('teacher_id')
                    ->label('Teacher')
                    ->relationship('teacher', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('subject_id')
                    ->label('Subject')
                    ->relationship('subject', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('school_class_id')
                    ->label('School Class')
                    ->relationship(
                        name: 'schoolClass', 
                        titleAttribute: 'name',
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn ($record) => $record->full_name
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('day')
                    ->label('Day')
                    ->options([
                        'Monday'    => 'Monday',
                        'Tuesday'   => 'Tuesday',
                        'Wednesday' => 'Wednesday',
                        'Thursday'  => 'Thursday',
                        'Friday'    => 'Friday',
                        'Saturday'  => 'Saturday',
                     ])
                    ->searchable()
                    ->preload()
                    ->required(),
                TimePicker::make('start_time')
                    ->label('Start Time')
                    ->seconds(false)
                    ->required(),
                TimePicker::make('end_time')
                    ->label('End Time')
                    ->seconds(false)
                    ->required(),
                TextInput::make('room')
                    ->label('Room')
                    ->maxLength(50)
                    ->placeholder('Example: Lab RPL 1')
                    ->default(null),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->required(),
            ]);
    }
}
