<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            if (Auth::user()->roles->contains('role_name', strtolower('admin'))) {
                return redirect()->route('admin.index');
            } else if (Auth::user()->roles->contains('role_name', strtolower('staff'))) {
                return redirect()->route('staff.index');
            }

        }
        return $next($request);
    }
}
