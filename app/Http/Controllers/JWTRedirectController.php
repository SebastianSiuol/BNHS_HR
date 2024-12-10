<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTRedirectController extends Controller
{
    public function sisAdmin(){
        try {
            // Get the authenticated user.
            $faculty = auth()->user();

            // Attach data to token
            $token = JWTAuth::claims([
                'faculty_code' => $faculty->faculty_code,
                'role' => $faculty->roles->pluck('role_name'),
                env('JWT_SECRET'),
                'expiresIn' => '12h'
            ])->fromUser($faculty);

            return Inertia::location("https://bhnhs-sis.onrender.com/admin/dashboard?access_token=" . $token);

        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not create token',
                'error_message' => $e
            ], 500);
        }
    }

    public function logiAdmin()
    {
        try {
            // Get the authenticated user.
            $faculty = auth()->user();

            // Attach data to token
            $token = JWTAuth::claims([
                'faculty_code' => $faculty->faculty_code,
                'role' => $faculty->roles->pluck('role_name'),
                env('JWT_SECRET'),
                'expiresIn' => '12h'
            ])->fromUser($faculty);

            return Inertia::location("https://batasan-logistics.onrender.com/admin_dashboard?access_token=" . $token);

        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not create token',
                'error_message' => $e
            ], 500);
        }
    }
}
