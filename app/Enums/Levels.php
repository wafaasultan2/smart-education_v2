<?php

namespace App\Enums;

enum Levels: string
{
    case First = 'First';
    case Second = 'Second';
    case Third = 'Third';
    case Fourth = 'Fourth';

    public function getValue(): string
    {
        return match($this) {
            self::First => 'المستوى الأول',
            self::Second => 'المستوى الثاني',
            self::Third => 'المستوى الثالث',
            self::Fourth => 'المستوى الرابع',
        };
    }
}
