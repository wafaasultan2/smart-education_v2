<?php

namespace App\Enums;

enum AcademicDegree: string
{
    case TEACHING_ASSISTANT = 'TEACHING_ASSISTANT';
    case LECTURER = 'LECTURER';
    case ASSISTANT_PROFESSOR = 'ASSISTANT_PROFESSOR';
    case ASSOCIATE_PROFESSOR = 'ASSOCIATE_PROFESSOR';
    case PROFESSOR = 'PROFESSOR';

    /**
     * Get the localized (Arabic) name for the academic degree.
     *
     * @return string Localized name of the academic degree.
     */
    public function getValue(): string
    {
        return match ($this) {
            self::PROFESSOR => 'أستاذ بروفسور',
            self::ASSOCIATE_PROFESSOR => 'أستاذ مشارك',
            self::ASSISTANT_PROFESSOR => 'أستاذ مساعد',
            self::LECTURER => 'مدرس',
            self::TEACHING_ASSISTANT => 'معيد',
        };
    }
}
