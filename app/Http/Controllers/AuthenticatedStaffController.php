<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedStaffController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.staff_login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {

        $credentials = $request->validate([
            'faculty_code' => 'required',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['faculty_code' => $credentials['faculty_code'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            $user = Auth::user();
            $isStaff = $user->roles()->where('role_id', 2)->exists();

            if ($isStaff) {
                return redirect()->intended(route('staff_index')); // Admin dashboard
            } else {
                Auth::logout(); // Log out the non-admin user
                $request->session()->invalidate(); // Invalidate the session
                $request->session()->regenerateToken(); // Regenerate CSRF token
                return back()->withErrors([
                    'msg' => 'You do not have access.',
                ]);
            }
            // Check if the user has the admin role
        }

        return back()->withErrors([
            'msg' => 'The provided credentials do not match our records.',
        ]);
    }
    /**
     * Handle log-out requests and destroys session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('Success', 'You have been logged out.');
    }
}
