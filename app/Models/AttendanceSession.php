<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttendanceSession extends Model
{
    protected $fillable = [
        'schedule_id',
        'attendance_date',
        'meeting_number',
        'is_closed',
    ];

    protected function casts(): array
    {
        return [
            'attendance_date' => 'date',
            'is_closed' => 'boolean',
        ];
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function getFullSessionAttribute(): string
    {
    return sprintf(
        'Meeting %d - %s - %s (%s)',
        $this->meeting_number,
        $this->schedule->subject->name,
        $this->schedule->schoolClass->full_name,
        $this->attendance_date->format('d M Y')
    );
    }

    public function getStudentsAttribute()
    {
    return $this->schedule
        ->schoolClass
        ->students()
        ->where('is_active', true)
        ->orderBy('name')
        ->get();
    }
}