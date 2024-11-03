<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleBasedAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        $roles = explode('|', $roles);

        $roleClassMap = [
            'teacher' => 'App\Models\Teacher',
            'student' => 'App\Models\Student',
            'admin' => 'App\Models\Admin',
        ];

        foreach ($roles as $role) {
            if (isset($roleClassMap[$role]) && Auth::user()->accountable_type === $roleClassMap[$role]) {
                return $next($request);
            }
        }

        abort(403);
    }
}
