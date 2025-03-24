<?php

namespace App\Enums;

enum Role: string
{
    case PortfolioManager = 'مدير الحوافظ';
    case SystemManager = 'المدير العام';
    case Admin = 'مدير النظام';
    case TableManager = 'مدير الجداول';

    /**
     * Get all roles as an array.
     *
     * @return array
     */
    public static function getRoles(): array
    {
        return array_map(fn(self $role) => $role->value, self::cases());
    }

    /**
     * Check if a specific role exists.
     *
     * @param string $role
     * @return bool
     */
    public static function hasRole(string $role): bool
    {
        return in_array($role, self::getRoles());
    }
}
