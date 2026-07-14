<?php

namespace App\Filament\Resources\AttendanceSessions\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AttendanceSessionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('schedule.id')
                    ->label('Schedule'),
                TextEntry::make('attendance_date')
                    ->date(),
                TextEntry::make('meeting_number')
                    ->numeric(),
                IconEntry::make('is_closed')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
