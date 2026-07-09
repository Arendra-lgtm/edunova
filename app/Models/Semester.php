<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Semester extends Model
{
    protected $fillable = [
        'academic_year_id',
        'name',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
    
    static::saving(function (Semester $semester) {
        if ($semester->is_active) {
            Semester::where('academic_year_id', $semester->academic_year_id)
                ->where('id', '!=', $semester->id)
                ->update([
                    'is_active' => false,
                ]);
        }
    });

    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }
}