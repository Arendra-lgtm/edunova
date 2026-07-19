<?php

namespace App\Filament\Resources\Attendances\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AttendancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('attendanceSession.meeting_number')
                    ->label('Meeting')
                    ->badge()
                    ->color('primary'),
                TextColumn::make('attendanceSession.schedule.teacher.name')
                    ->label('Teacher')
                    ->searchable(),
                TextColumn::make('attendanceSession.schedule.subject.name')
                    ->label('Subject')
                    ->searchable(),
                TextColumn::make('attendanceSession.schedule.schoolClass.full_name')
                    ->label('Class'),
                TextColumn::make('student.name')
                    ->label('Student')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'success' => 'present',
                        'warning' => ['permission', 'sick'],
                        'danger' => 'absent',
                        'info' => 'dispensation',
                    ]),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
