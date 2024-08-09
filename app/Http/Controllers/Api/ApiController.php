<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        //Validates registration credentials
        $validatedUser = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8|max:32',
        ]);

        //Response if Validation fails
        if ($validatedUser->fails()) {
            return response()->json([
                'status' => true,
                'message' => 'User registration failed',
            ], 401);
        }

        //Creates user if validations are successful
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);


        //Returns a response for successful registration
        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'token' => $user->createToken('apiToken')->plainTextToken
        ]);
    }

    public function login(Request $request)
    {

        //Validates user credentials
        $validatedUser = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:32',
        ]);

        //Response if Validation fails
        if ($validatedUser->fails()) {
            return response()->json([
                'status' => true,
                'message' => 'Log-in failed'
            ], 401);
        }

        // Check if the user is already logged in
        $user = User::where('email', $request->email)->first();
        if ($user && $user->tokens()->exists()) {
            return response()->json([
                'status' => true, // Keeping status true as required
                'message' => 'Email is already logged in!',
            ], 401);
        }

        //Authenticates the user, fails if there are no corresponding credentials found.
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => true,
                'message' => 'Invalid credentials',
            ], 401);
        }

        //Returns response
        $user = User::where('email', $request->email)->first();
        return response()->json([
            'status' => true,
            'message' => 'User log-in successfully',
            'token' => $user->createToken('apiToken')->plainTextToken
        ], 200);
    }

    public function logout(Request $request)
    {
        $userName = $request->user()->name;
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => "$userName logged out",
        ]);
    }
    public function sendemail(Request $request)
    {
        return response()->json([
            'status' => true,
            'message' => "an error has occured",
        ], 401);
    }
}



