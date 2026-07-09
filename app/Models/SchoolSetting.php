<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolSetting extends Model
{
    protected $fillable = [
        'school_name',
        'principal_name',
        'email',
        'phone',
        'website',
        'address',
        'logo',
        'favicon',
        'timezone',
        'locale',
    ];
}