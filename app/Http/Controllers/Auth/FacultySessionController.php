<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class FacultySessionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Public/Auth/Login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $credentials = $request->validate([
        'faculty_code' => 'required',
        'password' => 'required|min:6',
    ]);

    if (!Auth::attempt($credentials)) {
        return back()->withErrors(['message' => 'Invalid credentials, please try again']);
    }

    $request->session()->regenerate();
    $user = Auth::user();

    // Map roles to redirect paths
    $roleRedirects = [
        'hr_admin' => route('admin.dashboard'),
        'hr_faculty' => route('faculty.dashboard'),
        'sis_admin' => "https://bhnhs-sis.onrender.com/admin/dashboard",
        'sis_registrar' => "https://bhnhs-sis.onrender.com/admin/dashboard",
        'sis_faculty' => "https://bhnhs-sis.onrender.com/faculty/home",
        // 'logi_admin' => "https://batasan-logistics.onrender.com/admin_dashboard",
        // 'logi_admin' => "http://192.168.0.111:8000/admin_dashboard",
        'logi_admin' => "http://192.168.0.111:8000/redirect",

    ];

    foreach ($roleRedirects as $role => $redirectUrl) {
        if ($user->roles()->where('role_name', $role)->exists()) {
            return $this->handleRedirect($role, $credentials, $redirectUrl);
        }
    }

    // No role found
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return back()->withErrors([
        'message' => 'Your account has no dedicated role yet. Please contact management!',
    ]);
}

    /**
     * Destroys resource.
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('/');
    }

    private function handleRedirect($role, $credentials, $redirectUrl)
    {
        if (in_array($role, ['hr_admin', 'hr_faculty'])) {
            return redirect()->intended($redirectUrl)
                ->with('success', 'Successfully Logged In!');
        }

        try {
            $token = $this->generateJwtToken($credentials);
            return Inertia::location("{$redirectUrl}?access_token={$token}");
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not create token',
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    private function generateJwtToken($credentials)
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            throw new JWTException('Invalid credentials');
        }

        $faculty = Auth::user();

        return JWTAuth::claims([
            'faculty_code' => $faculty->faculty_code,
            'role' => $faculty->roles->pluck('role_name'),
            env('JWT_SECRET'),
            'expiresIn' => '12h',
        ])->fromUser($faculty);
    }
}
