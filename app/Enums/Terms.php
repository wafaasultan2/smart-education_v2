<?php

namespace App\Enums;

enum Terms : string
{
    case First = 'First';
    case Second = 'Second';

    public function getValue(): string
    {
        return match($this) {
            self::First => 'الفصل الدراسي الأول',
            self::Second => 'الفصل الدراسي الثاني',
        };
    }
}
