<?php

namespace App\Filament\Widgets;

use App\Models\AttendanceSession;
use App\Models\Student;
use App\Models\Teacher;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EduNovaStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', Student::count())
                ->description('All registered students')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Total Teachers', Teacher::count())
                ->description('Active teachers')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),

            Stat::make('Attendance Sessions', AttendanceSession::count())
                ->description('Total attendance meetings')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('warning'),
        ];
    }
}