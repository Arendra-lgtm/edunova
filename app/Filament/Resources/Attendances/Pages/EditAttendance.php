<?php

namespace App\Filament\Resources\Attendances\Pages;

use App\Filament\Resources\Attendances\AttendanceResource;
use Filament\Resources\Pages\EditRecord;

class EditAttendance extends EditRecord
{
    protected static string $resource = AttendanceResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        if ($this->record->attendanceSession->is_closed) {
            abort(403, 'Attendance session is already closed.');
        }
    }
}