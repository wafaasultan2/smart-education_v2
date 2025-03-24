<?php

namespace App\Enums;

enum Days : string
{
    case Saturday = 'Saturday';
    case Sunday = 'Sunday';
    case Monday = 'Monday';
    case Tuesday = 'Tuesday';
    case Wednesday = 'Wednesday';
    case Thursday = 'Thursday';
    case Friday = 'Friday';

    public function getValue(): string
    {
        return match($this) {
            self::Saturday => 'السبت',
            self::Sunday => 'الأحد',
            self::Monday => 'الإثنين',
            self::Tuesday => 'الثلاثاء',
            self::Wednesday => 'الأربعاء',
            self::Thursday => 'الخميس',
            self::Friday => 'الجمعة',
        };
    }
}
