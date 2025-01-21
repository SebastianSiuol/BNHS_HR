<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectUnauthorizedUser
{

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $userRoles = Auth::user()->roles->pluck('role_name')->map(fn($role) => strtolower($role));
            $url_request = $request->segment(1);

            if ($url_request === 'faculty' && !$userRoles->contains('hr_faculty')) {
                return redirect()->route('admin.dashboard');
            }

            if ($url_request === 'admin' && !$userRoles->contains('hr_admin') && !$userRoles->contains('hr_manager')) {
                return redirect()->route('faculty.dashboard');
            }
        } else {
            return redirect()->route('/');
        }

        return $next($request);
    }
}
