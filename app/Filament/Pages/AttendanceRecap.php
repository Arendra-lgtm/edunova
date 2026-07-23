<?php

namespace App\Filament\Pages;

use App\Models\Attendance;
use App\Models\SchoolClass;
use App\Models\Subject;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use UnitEnum;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Pages\Page;

class AttendanceRecap extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static ?string $navigationLabel = 'Attendance Recap';

    protected static string|UnitEnum|null $navigationGroup = 'Attendance';

    protected string $view = 'filament.pages.attendance-recap';

    public ?int $classId = null;

    public ?int $subjectId = null;

    public ?string $startDate = null;

    public ?string $endDate = null;

    public ?string $filteredStartDate = null;

    public ?string $filteredEndDate = null;

    public function mount(): void
    {   
        $this->startDate = now()->startOfMonth()->toDateString();
        $this->endDate = now()->endOfMonth()->toDateString();

        $this->filteredStartDate = $this->startDate;
        $this->filteredEndDate = $this->endDate;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('classId')
                    ->label('Class')
                    ->options(
                        SchoolClass::all()
                            ->mapWithKeys(fn ($class) => [
                                $class->id => $class->full_name
                            ])
                            ->toArray()
                    )
                    ->searchable(),

                Select::make('subjectId')
                    ->label('Subject')
                    ->options(Subject::pluck('name', 'id'))
                    ->searchable(),

                DatePicker::make('startDate')
                    ->label('Start Date'),

                DatePicker::make('endDate')
                    ->label('End Date'),
            ])
            ->columns(4);
    }

    public function getAttendanceQuery()
    {
        return Attendance::query()
            ->whereHas('attendanceSession', function ($query) {
                $query->whereBetween('attendance_date', [
                    $this->startDate,
                    $this->endDate,
                ]);
            })
            ->when($this->classId, function ($query) {
                $query->whereHas('attendanceSession.schedule', function ($q) {
                    $q->where('school_class_id', $this->classId);
                });
            })
            ->when($this->subjectId, function ($query) {
                $query->whereHas('attendanceSession.schedule', function ($q) {
                    $q->where('subject_id', $this->subjectId);
                });
            });
    }

    public function getPresentCountProperty(): int
    {
        return (clone $this->getAttendanceQuery())
            ->where('status', 'present')
            ->count();
    }

    public function getPermissionCountProperty(): int
    {
        return (clone $this->getAttendanceQuery())
            ->where('status', 'permission')
            ->count();
    }

    public function getSickCountProperty(): int
    {
        return (clone $this->getAttendanceQuery())
            ->where('status', 'sick')
            ->count();
    }

    public function getAbsentCountProperty(): int
    {
        return (clone $this->getAttendanceQuery())
            ->where('status', 'absent')
            ->count();
    }

    public function applyFilter(): void
    {
        $query = Attendance::query()
            ->whereHas('attendanceSession', function ($q) {
                $q->whereBetween('attendance_date', [
                    $this->startDate,
                    $this->endDate,
                ]);

                if ($this->classId) {
                    $q->whereHas('schedule.schoolClass', function ($qq) {
                        $qq->where('id', $this->classId);
                    });
                }

                if ($this->subjectId) {
                    $q->whereHas('schedule.subject', function ($qq) {
                        $qq->where('id', $this->subjectId);
                    });
                }
            });

        $this->recapData = [
            'present' => (clone $query)->where('status', 'present')->count(),
            'sick' => (clone $query)->where('status', 'sick')->count(),
            'permission' => (clone $query)->where('status', 'permission')->count(),
            'absent' => (clone $query)->where('status', 'absent')->count(),
        ];
    }
}