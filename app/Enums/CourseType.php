<?php

namespace App\Enums;

enum CourseType : string
{
    case Mandatory = 'Mandatory';
    case Specialized = 'Specialized';

    public function getValue(): string
    {
        return match($this) {
            self::Mandatory => 'متطلبة',
            self::Specialized => 'تخصصية',
        };
    }
}
