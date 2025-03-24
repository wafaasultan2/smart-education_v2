<?php

namespace App\Enums;

enum TypeLecture: string
{
    case Practical = 'Practical';
    case Theoretical = 'Theoretical';

    public function getValue(): string
    {
        return match ($this) {
            self::Practical => 'عملي',
            self::Theoretical => 'نظري',
        };
    }
}
