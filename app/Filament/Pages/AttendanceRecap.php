<?php

namespace App\Filament\Pages;

use App\Models\SchoolClass;
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

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'school_class_id' => null,
            'start_date' => now()->startOfMonth(),
            'end_date' => now(),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('school_class_id')
                    ->label('School Class')
                    ->options(
                        SchoolClass::query()
                            ->get()
                            ->pluck('full_name', 'id')
                    )
                    ->searchable()
                    ->placeholder('All Classes'),

                DatePicker::make('start_date')
                    ->label('Start Date')
                    ->required(),

                DatePicker::make('end_date')
                    ->label('End Date')
                    ->required(),
            ])
            ->columns(3)
            ->statePath('data');
    }
}