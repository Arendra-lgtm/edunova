<?php

namespace App\Filament\Resources\AcademicYears\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AcademicYearsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

            
            
        TextColumn::make('name')
            ->label('Academic Year')
            ->searchable()
            ->sortable(),

        TextColumn::make('start_date')
            ->label('Start')
            ->date('d M Y')
            ->sortable(),

        TextColumn::make('end_date')
            ->label('End')
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
