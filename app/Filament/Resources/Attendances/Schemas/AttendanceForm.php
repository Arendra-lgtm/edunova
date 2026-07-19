<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use App\Models\AttendanceSession;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('attendance_session_id')
                    ->label('Attendance Session')
                    ->relationship('attendanceSession', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_session)
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('student_id')
                    ->label('Student')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('status')
                    ->options([
                        'present' => 'Present',
                        'permission' => 'Permission',
                        'sick' => 'Sick',
                        'absent' => 'Absent',
                        'dispensation' => 'Dispensation',
                     ])
                    ->default('present')
                    ->required(),
                Textarea::make('note')
                    ->label('Note')
                    ->rows(3)
                    ->placeholder('Optional note...')
                    ->columnSpanFull(),
            ]);
    }
}
