<?php

namespace App\Filament\Resources\Students\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('total_absent', 'desc')
            ->columns([
                TextColumn::make('academicYear.name')
                    ->label('Academic Year')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('schoolClass.full_name')
                    ->label('School Class'),
                TextColumn::make('nis')
                    ->label('NIS')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nisn')
                    ->label('NISN')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Student')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('total_absent')
                    ->label('Total Alpha')
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state >= 5 => 'danger',
                        $state >= 3 => 'warning',
                        $state >= 1 => 'info',
                        default => 'gray',
                    })
                    ->sortable(query: function ($query, string $direction) {
                        return $query->withCount([
                            'attendances as total_absent' => fn ($q) =>
                                $q->where('status', 'absent')
                        ])->orderBy('total_absent', $direction);
                    }),
                TextColumn::make('attendance_summary.present')
                    ->label('H')
                    ->badge()
                    ->color('success'),
                TextColumn::make('attendance_summary.sick')
                    ->label('S')
                    ->badge()
                    ->color('info'),
                TextColumn::make('attendance_summary.permission')
                    ->label('I')
                    ->badge()
                    ->color('warning'),
                TextColumn::make('attendance_summary.absent')
                    ->label('A')
                    ->badge()
                    ->color('danger'),
                TextColumn::make('attendance_summary.dispensation')
                    ->label('D')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('gender')
                    ->badge(),
                TextColumn::make('birth_date')
                    ->label('Birth Date')
                    ->date('d M Y')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name')
            ->filters([
                Filter::make('has_absent')
                    ->label('Has Alpha')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereHas('attendances', fn (Builder $q) =>
                            $q->where('status', 'absent')
                        )
                    ),
                Filter::make('alpha_3')
                    ->label('Alpha ≥ 3')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereHas('attendances', fn (Builder $q) =>
                            $q->where('status', 'absent'),
                            '>=',
                            3
                        )
                    ),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
