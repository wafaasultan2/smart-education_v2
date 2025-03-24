<?php
namespace App\Enums;

enum TimeLecture: string
{
    case EIGHT_TO_TEN = 'EIGHT_TO_TEN';
    case TEN_TO_TWELVE = 'TEN_TO_TWELVE';
    case TWELVE_TO_TWO = 'TWELVE_TO_TWO';
    case TWO_TO_FOUR = 'TWO_TO_FOUR';

    public function getValue(): string
    {
        return match($this) {
            self::EIGHT_TO_TEN => '08:00 - 10:00',
            self::TEN_TO_TWELVE => '10:00 - 12:00',
            self::TWELVE_TO_TWO => '12:00 - 02:00',
            self::TWO_TO_FOUR => '02:00 - 04:00',
        };
    }
}
