<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultySessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.faculty-login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $credentials = $request->validate([
            'employee_id' => 'required',
            'password' => 'required|min:6',
        ]);


        if (Auth::attempt(['faculty_code' => $credentials['employee_id'], 'password' => $credentials['password']])) {

            $request->session()->regenerate();
            $user = Auth::user();
            $isAdmin = $user->roles()->where('role_name', 'admin')->exists();
            $isStaff = $user->roles()->where('role_name', 'staff')->exists();

            if ($isAdmin) {
                return redirect()
                    ->intended(route('admin_index'))
                    ->with('success', 'Successfully Logged In!');// Admin dashboard
            }else if ($isStaff) {
                return redirect()
                    ->intended(route('staff_index'))
                    ->with('success', 'Successfully Logged In!');// Staff dashboard
            } else {

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'msg' => 'Your account has no dedicated role yet. Please contact management!',
                ]);
            }
        }

        return back()->withErrors([
            'msg' => 'Invalid credentials, please try again',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->intended(route('/'))->with('success', 'Successfully Logged Out!');
    }
}
