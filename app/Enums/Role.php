<?php

namespace App\Enums;

class Role
{
    public const SUPER_ADMIN = 'Super Admin';

    public const SCHOOL_ADMIN = 'School Admin';

    public const TEACHER = 'Teacher';

    public const STUDENT = 'Student';

    public static function all(): array
    {
        return [
            self::SUPER_ADMIN,
            self::SCHOOL_ADMIN,
            self::TEACHER,
            self::STUDENT,
        ];
    }
}