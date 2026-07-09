<?php

namespace App\Filament\Resources\Semesters\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SemestersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
    TextColumn::make('academicYear.name')
        ->label('Academic Year')
        ->sortable()
        ->searchable(),

    TextColumn::make('name')
        ->label('Semester')
        ->badge()
        ->sortable(),

    TextColumn::make('start_date')
        ->date('d M Y')
        ->sortable(),

    TextColumn::make('end_date')
        ->date('d M Y')
        ->sortable(),

    IconColumn::make('is_active')
        ->label('Active')
        ->boolean(),

    TextColumn::make('created_at')
        ->dateTime('d M Y H:i')
        ->toggleable(isToggledHiddenByDefault: true),
         ])

            ->defaultSort('start_date', 'desc')
            
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
