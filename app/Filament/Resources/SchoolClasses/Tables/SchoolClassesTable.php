<?php

namespace App\Filament\Resources\SchoolClasses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchoolClassesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
    TextColumn::make('academicYear.name')
        ->label('Academic Year')
        ->badge()
        ->sortable()
        ->searchable(),

    TextColumn::make('level')
        ->badge()
        ->color('primary')
        ->sortable(),

    TextColumn::make('major')
        ->badge()
        ->color('success')
        ->searchable(),

    TextColumn::make('name')
        ->label('Class')
        ->sortable()
        ->searchable(),

    TextColumn::make('capacity')
        ->label('Capacity')
        ->alignCenter()
        ->sortable(),

    IconColumn::make('is_active')
        ->label('Active')
        ->boolean(),

    TextColumn::make('created_at')
        ->dateTime('d M Y H:i')
        ->toggleable(isToggledHiddenByDefault: true),
       
            ])
            ->defaultSort('level')
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
