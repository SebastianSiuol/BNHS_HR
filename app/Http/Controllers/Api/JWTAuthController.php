<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthController extends Controller
{
    public function store(Request $request){
        try {
            if (! $token = JWTAuth::attempt(['faculty_code' => $request->faculty_code, 'password' => $request->password])) {
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

            return response()->json(compact('token'));

        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not create token',
                'error_message' => $e
            ], 500);
        }
    }
}
