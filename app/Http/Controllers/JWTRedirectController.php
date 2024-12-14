<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTRedirectController extends Controller
{
    public function sis(){
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

            return redirect()->away("http://192.168.2.62:5173/admin/dashboard?access_token=" . $token);

        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not create token',
                'error_message' => $e
            ], 500);
        }
    }

    public function logistics()
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

            return redirect()->away("http://192.168.2.42:8000/admin_dashboard?access_token=" . $token);

        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not create token',
                'error_message' => $e
            ], 500);
        }
    }
}
