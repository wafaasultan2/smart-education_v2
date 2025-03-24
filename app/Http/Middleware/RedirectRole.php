<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectRole
{
    private $routes = [
        Role::Admin->value => ['all'],
        Role::SystemManager->value => ['dashboard', 'department', 'plan', 'course', 'classroom', 'teacher', 'plan.report', 'students'],
        Role::PortfolioManager->value => ['attendance-record'],
        Role::TableManager->value => ['lecture'],
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login'); // أو أي مسار افتراضي للمستخدم غير المسجل
        }

        $role = auth()->user()->role;

        if (isset($this->routes[$role->value]) &&
            (in_array($request->route()->getName(), $this->routes[$role->value]) || $role == Role::Admin)) {
            return $next($request);
        }

        return redirect()->route($this->routes[$role->value][0] ?? 'default.route');
    }
}
