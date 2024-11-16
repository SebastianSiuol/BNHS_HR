<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

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
            $isAdmin = $user->roles()->where('role_name', 'hr_admin')->exists();
            $isStaff = $user->roles()->where('role_name', 'hr_faculty')->exists();

            $isSISAdmin = $user->roles()->where('role_name', 'sis_admin')->exists();
            $isSISRegistrar = $user->roles()->where('role_name', 'sis_registrar')->exists();
            $isSISStaff = $user->roles()->where('role_name', 'sis_faculty')->exists();

            $isLogi = $user->roles()->where('role_name', 'logi_admin')->exists();

//            $request->JWT::parseToken();

            /* Start of Experimentation */
            $user_roles = $user->roles->pluck('role_name');

            $separated = $user_roles->map(function ($role) {
               return explode("_", $role);
            });

            $module_name = $separated->map(function ($separated_role) {
                return $separated_role[0];
            });

            $role_name = $separated->map(function ($separated_role) {
                return $separated_role[1];
            });

            $roleHaveSIS = false;
            $roleHaveHR = false;

            foreach ($module_name as $name) {
                if($name == "sis"){
                    $roleHaveSIS = true;
                    break;
                }
            }
            /* End of Experimentation */

            if ($isAdmin) {

                return redirect()
                    ->intended(route('admin.index'))
                    ->with('success', 'Successfully Logged In!');// Admin dashboard

            }else
                if ($isStaff) {

                return redirect()
                    ->intended(route('staff.index'))
                    ->with('success', 'Successfully Logged In!');// Staff dashboard

            }else if ($isSISAdmin || $isSISRegistrar) {

                try {
                    if (! $token = JWTAuth::attempt(['faculty_code' => $credentials['employee_id'], 'password' => $credentials['password']])) {
                        return response()->json(['error' => 'Invalid credentials'], 401);
                    }

                    // Get the authenticated user.
                    $faculty = auth()->user();

                    // Attach data to token
                    $token = JWTAuth::claims([
                        'faculty_code' => $faculty->faculty_code,
                        'role' => $faculty->roles->pluck('role_name'),
                        env('JWT_SECRET'),
                        'expiresIn' => '12h'
                    ])->fromUser($faculty);

                    return redirect()->away("https://bhnhs-sis.onrender.com/admin/dashboard?access_token=" . $token);

                } catch (JWTException $e) {
                    return response()->json([
                        'error' => 'Could not create token',
                        'error_message' => $e
                    ], 500);
                }

            }else if ($isSISStaff) {

                    try {
                        if (! $token = JWTAuth::attempt(['faculty_code' => $credentials['employee_id'], 'password' => $credentials['password']])) {
                            return response()->json(['error' => 'Invalid credentials'], 401);
                        }

                        // Get the authenticated user.
                        $faculty = auth()->user();

                        // Attach data to token
                        $token = JWTAuth::claims([
                            'faculty_code' => $faculty->faculty_code,
                            'role' => $faculty->roles->pluck('role_name'),
                            env('JWT_SECRET'),
                            'expiresIn' => '12h'
                        ])->fromUser($faculty);

                        return redirect()->away("https://bhnhs-sis.onrender.com/faculty/home?access_token=" . $token);

                    } catch (JWTException $e) {
                        return response()->json([
                            'error' => 'Could not create token',
                            'error_message' => $e
                        ], 500);
                    }

            }else if ($isLogi) {


                    try {
                        if (! $token = JWTAuth::attempt(['faculty_code' => $credentials['employee_id'], 'password' => $credentials['password']])) {
                            return response()->json(['error' => 'Invalid credentials'], 401);
                        }

                        // Get the authenticated user.
                        $faculty = auth()->user();


                        // Attach data to token
                        $token = JWTAuth::claims([
                            'faculty_code' => $faculty->faculty_code,
                            'role' => $faculty->roles->pluck('role_name'),
                            env('JWT_SECRET'),
                            'expiresIn' => '12h'
                        ])->fromUser($faculty);

                        return redirect()->away("https://batasan-logistics.onrender.com/admin_dashboard?access_token=" . $token);

                    } catch (JWTException $e) {
                        return response()->json([
                            'error' => 'Could not create token',
                            'error_message' => $e
                        ], 500);
                    }

                } else {

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'message' => 'Your account has no dedicated role yet. Please contact management!',
                ]);
            }
        }

        return back()->withErrors([
            'message' => 'Invalid credentials, please try again',
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
