<?php

namespace App\Enums;

enum AttendanceType: string
{
        // رسمي
    case Official = 'رسمي';
        // تعويضي
    case Compensatory = 'تعويضي';
    public static function getValues(): array
    {
        return array_map(fn(self $role) => $role->value, self::cases());
    }
}
