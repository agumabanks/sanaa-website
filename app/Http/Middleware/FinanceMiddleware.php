<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        $financeRoles = ['FinanceEditor', 'FinancePublisher', 'FinanceAdmin'];

        $hasRole = false;
        // Allow full Admins
        if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
            $hasRole = true;
        }
        // Spatie roles support
        if (method_exists($user, 'hasAnyRole')) {
            $hasRole = $user->hasAnyRole($financeRoles);
        }
        // roles stored as JSON/text
        if (!$hasRole && isset($user->roles)) {
            $roles = $user->roles;
            if (is_string($roles)) {
                $decoded = json_decode($roles, true);
                $roles = is_array($decoded) ? $decoded : [$roles];
            }
            if (is_array($roles)) {
                $hasRole = count(array_intersect($financeRoles, $roles)) > 0;
            }
        }
        // single role column fallback
        if (!$hasRole && isset($user->role) && in_array($user->role, $financeRoles, true)) {
            $hasRole = true;
        }

        if (!$hasRole) {
            abort(403, 'Access denied. Finance admin privileges required.');
        }

        return $next($request);
    }
}
