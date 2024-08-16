<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

            return redirect()->intended(route('staff_index'));
        }

        return back()->withErrors([
            'msg' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('/')->with('success', 'You have been logged out.');
    }
}
