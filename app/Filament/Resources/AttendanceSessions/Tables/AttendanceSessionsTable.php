<?php

namespace App\Filament\Resources\AttendanceSessions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Attendance;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class AttendanceSessionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('schedule.teacher.name')
                    ->label('Teacher')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('schedule.subject.name')
                    ->label('Subject')
                    ->sortable()
                    ->searchable(),    
                TextColumn::make('schedule.schoolClass.full_name')
                    ->label('Class'),    
                TextColumn::make('attendance_date')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('meeting_number')
                    ->label('Meeting')
                    ->badge()
                    ->formatStateUsing(fn ($state) => "Meeting {$state}"),
                TextColumn::make('is_closed')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Closed' : 'Open')
                    ->color(fn (bool $state): string => $state ? 'danger' : 'success'),
                TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),

                 Action::make('openAttendance')
                        ->label('Open Attendance')
                        ->icon('heroicon-o-arrow-top-right-on-square')
                        ->color('info')
                        ->url(fn ($record) =>
                            route('filament.admin.resources.attendances.index', [
                                'tableFilters[attendance_session_id][value]' => $record->id,
                            ])
                        ),

                Action::make('generateAttendance')
                        ->label('Generate Attendance')
                        ->icon('heroicon-o-users')
                        ->color('success')
                        ->disabled(fn ($record) => $record->is_closed)
                        ->requiresConfirmation()
                        ->modalHeading('Generate attendance sheet')
                        ->modalDescription('This will create attendance records for all active students in this class.')
                        ->action(function ($record) {

                            $created = 0;

                            foreach ($record->students as $student) {

                                $attendance = Attendance::firstOrCreate(
                                    [
                                        'attendance_session_id' => $record->id,
                                        'student_id' => $student->id,
                                    ],
                                    [
                                        'status' => 'present',
                                    ]
                                );

                                if ($attendance->wasRecentlyCreated) {
                                    $created++;
                                }
                            }

                Notification::make()
                        ->title('Attendance generated')
                        ->body("{$created} attendance records created successfully.")
                        ->success()
                        ->send();
                }),

                EditAction::make(

                ),
                Action::make('closeSession')
                        ->label('Close Session')
                        ->icon('heroicon-o-lock-closed')
                        ->color('warning')
                        ->visible(fn ($record) => ! $record->is_closed)
                        ->requiresConfirmation()
                        ->modalHeading('Close this attendance session?')
                        ->modalDescription('After closing, attendance records can no longer be edited.')
                        ->action(function ($record) {

                            $record->update([
                                'is_closed' => true,
                            ]);

                            Notification::make()
                                ->title('Session closed')
                                ->body('Attendance session has been locked successfully.')
                                ->success()
                                ->send();
                        }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
