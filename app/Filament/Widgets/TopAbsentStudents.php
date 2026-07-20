<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class TopAbsentStudents extends BaseWidget
{
    //protected static ?string $heading = '🚨 Top 5 Most Absent Students';
    protected static ?string $heading = '🚨 Top 5 Siswa Paling Sering Alpha';

    protected int|string|array $columnSpan = 'full';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                Student::query()
                    ->withCount([
                        'attendances as total_absent' => fn (Builder $query) =>
                            $query->where('status', 'absent'),
                    ])
                    ->having('total_absent', '>', 0)
                    ->orderByDesc('total_absent')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Student')
                    ->searchable(),

                Tables\Columns\TextColumn::make('schoolClass.full_name')
                    ->label('Class'),

                Tables\Columns\TextColumn::make('total_absent')
                    ->label('Alpha')
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state >= 5 => 'danger',
                        $state >= 3 => 'warning',
                        default => 'info',
                    }),
            ]);
    }
}   