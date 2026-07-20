<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'academic_year_id',
        'school_class_id',
        'nis',
        'nisn',
        'name',
        'gender',
        'birth_date',
        'address',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'is_active'  => 'boolean',
        ];
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function attendances(): HasMany
    {
    return $this->hasMany(Attendance::class);
    }

    public function getAttendanceSummaryAttribute(): array
    {
    return [
        'present' => $this->attendances()->where('status', 'present')->count(),
        'sick' => $this->attendances()->where('status', 'sick')->count(),
        'permission' => $this->attendances()->where('status', 'permission')->count(),
        'absent' => $this->attendances()->where('status', 'absent')->count(),
        'dispensation' => $this->attendances()->where('status', 'dispensation')->count(),
    ];
    }

    public function getTotalAbsentAttribute(): int
    {
    return $this->attendances()
        ->where('status', 'absent')
        ->count();
    }
}