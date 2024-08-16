<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthenticatedRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the user has the specified role
        if (Auth::user()->roles->contains('role_name', ucfirst($role))) {
            return $next($request);
        }

        // If the user is not authenticated or doesn't have the right role, redirect them
        abort(403, 'Unauthorized action.');
    }
}
