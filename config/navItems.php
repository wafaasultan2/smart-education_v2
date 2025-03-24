<?php

/**
 * هذه المصفوفة تمثل قائمة التنقل (Navigation) في التطبيق.
 * كل عنصر في المصفوفة يمكن أن يكون رابطًا مباشرًا أو قائمة منسدلة تحتوي على روابط.
 *
 * الحقول المتاحة لكل عنصر:
 * - 'name': اسم العنصر (سيظهر كاسم في واجهة المستخدم).
 * - 'route': مسار الرابط إذا كان العنصر رابطًا مباشرًا (اختياري).
 * - 'type': نوع العنصر ('nav' لرابط مباشر، 'dropdown' لقائمة منسدلة).
 * - 'icon': أيقونة SVG لتمثيل العنصر.
 * - 'dropdowns': مصفوفة تحتوي على مجموعات فرعية للقوائم المنسدلة (اختياري إذا كان 'type' هو 'dropdown').
 *
 * مثال على عنصر رابط مباشر:
 * [
 *     'name' => 'الرئيسية',
 *     'route' => 'dashboard',
 *     'type' => 'nav',
 *     'icon' => '<svg>...</svg>',
 * ]
 *
 * مثال على قائمة منسدلة تحتوي على روابط فرعية:
 * [
 *     'name' => 'الأقسام',
 *     'type' => 'dropdown',
 *     'route' => 'department',
 *     'icon' => '<svg>...</svg>',
 *     'dropdowns' => [
 *         [
 *             ['name' => 'المستخدمين', 'route' => 'users.index'],
 *             ['name' => 'المنتجات', 'route' => 'products.index'],
 *         ],
 *         [
 *             ['name' => 'الطلبات', 'route' => 'orders.index'],
 *             ['name' => 'التقارير', 'route' => 'charts.index'],
 *         ],
 *     ],
 * ]
 */

use App\Enums\Role;

return [
    [
        'name' => 'الرئيسية',
        'route' => 'dashboard',
        'roles' => [Role::SystemManager->value, Role::Admin->value],
        'type' => 'nav',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
            </svg>',
    ],
    [
        'name' => 'الأقسام',
        'route' => 'department',
        'roles' => [Role::SystemManager->value, Role::Admin->value],
        'type' => 'nav',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-vector-bezier"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 14m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /><path d="M17 14m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /><path d="M10 6m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /><path d="M10 8.5a6 6 0 0 0 -5 5.5" /><path d="M14 8.5a6 6 0 0 1 5 5.5" /><path d="M10 8l-6 0" /><path d="M20 8l-6 0" /><path d="M3 8m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M21 8m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>',
    ],

    [
        'name' => 'الخطط',
        'route' => 'plan',
        'roles' => [Role::SystemManager->value, Role::Admin->value],
        'type' => 'nav',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <rect x="4" y="5" width="16" height="16" rx="2" />
                <line x1="16" y1="3" x2="16" y2="7" />
                <line x1="8" y1="3" x2="8" y2="7" />
                <line x1="4" y1="9" x2="20" y2="9" />
                <line x1="4" y1="15" x2="20" y2="15" />
                <line x1="4" y1="19" x2="20" y2="19" />
            </svg>',
    ],

    [
        'name' => 'المواد',
        'route' => 'course',
        'roles' => [Role::SystemManager->value, Role::Admin->value],
        'type' => 'nav',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-book-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z" /><path d="M19 16h-12a2 2 0 0 0 -2 2" /><path d="M9 8h6" /></svg>',
    ],

    [
        'name' => 'القاعات',
        'route' => 'classroom',
        'roles' => [Role::SystemManager->value, Role::Admin->value],
        'type' => 'nav',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-building"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M9 8l1 0" /><path d="M9 12l1 0" /><path d="M9 16l1 0" /><path d="M14 8l1 0" /><path d="M14 12l1 0" /><path d="M14 16l1 0" /><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" /></svg>',
    ],

    [
        'name' => 'المعلمون',
        'route' => 'teacher',
        'roles' => [Role::SystemManager->value, Role::Admin->value],
        'type' => 'nav',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-square-rounded"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" /><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" /><path d="M6 20.05v-.05a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.05" /></svg>',
    ],

    [
        'name' => 'المستخدمين',
        'route' => 'users',
        'roles' => [Role::Admin->value],
        'type' => 'nav',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>',
    ],

    [
        'name' => 'الطلاب',
        'route' => 'students',
        'roles' => [Role::SystemManager->value, Role::Admin->value],
        'type' => 'nav',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-school"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>',
    ],

    [
        'name' => 'المحاضرات',
        'route' => 'lecture',
        'roles' => [Role::TableManager->value, Role::Admin->value],
        'type' => 'nav',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-building"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M9 8l1 0" /><path d="M9 12l1 0" /><path d="M9 16l1 0" /><path d="M14 8l1 0" /><path d="M14 12l1 0" /><path d="M14 16l1 0" /><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" /></svg>',
    ],

    [
        'name' => 'حوافظ الحضور',
        'route' => 'attendance-record',
        'roles' => [Role::PortfolioManager->value, Role::Admin->value],
        'type' => 'nav',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-list-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3.5 5.5l1.5 1.5l2.5 -2.5" /><path d="M3.5 11.5l1.5 1.5l2.5 -2.5" /><path d="M3.5 17.5l1.5 1.5l2.5 -2.5" /><path d="M11 6l9 0" /><path d="M11 12l9 0" /><path d="M11 18l9 0" /></svg>',
    ],

    [
        'name' => 'الإعدادات',
        'route' => 'settings',
        'roles' => [Role::Admin->value],
        'type' => 'nav',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>',
    ],
];
