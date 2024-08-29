<?php

namespace App\Http\Controllers;

    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

class AuthenticatedAdminController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.admin_login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {

        $credentials = $request->validate([
            'admin_id' => 'required',
            'password' => 'required|min:6',
        ]);


        if (Auth::attempt(['faculty_code' => $credentials['admin_id'], 'password' => $credentials['password']])) {

            $request->session()->regenerate();
            $user = Auth::user();
            $isAdmin = $user->roles()->where('role_id', 1)->exists();

            if ($isAdmin) {

                return redirect()
                    ->intended(route('admin_index'))
                    ->with('success', 'Successfully Logged In!');// Admin dashboard
            } else {
                Auth::logout(); // Log out the non-admin user
                $request->session()->invalidate(); // Invalidate the session
                $request->session()->regenerateToken(); // Regenerate CSRF token
                return back()->withErrors([
                    'msg' => 'You do not have admin access.',
                ]);
            }
            // Check if the user has the admin role
        }

        return back()->withErrors([
            'msg' => 'Invalid credenials, please try again',
        ]);
    }
    /**
     * Handle log-out requests and destroys session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
