<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        //Validates registration credentials
        $validatedFaculty = Validator::make($request->all(), [
            'name' => 'required|min:3|max:64',
            'email' => 'required|email|unique:faculties|max:255',
            'password' => 'required|min:8|max:32',
        ]);

        //Response if Validation fails
        if ($validatedFaculty->fails()) {
            return response()->json([
                'status' => true,
                'message' => 'Factory registration failed',
            ], 401);
        }

        //Creates user if validations are successful
        $faculty = Faculty::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);


        //Returns a response for successful registration
        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'token' => $faculty->createToken('apiToken')->plainTextToken
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
        $user = Faculty::where('email', $request->email)->first();
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
        $user = Faculty::where('email', $request->email)->first();
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

    public function authemail(Request $request)
    {
        $foundFaculty = Faculty::where('email', $request->email)->first();

        if(!$foundFaculty){
            return response()->json(['error' => 'Email not found!'], 404);
        }

        return response()->json([
            'email' => $foundFaculty->email,
            'name' => $foundFaculty->name,
            'password' => $foundFaculty->password,
            'roles' => $foundFaculty->roles->pluck('role_name'),
        ]);
    }
}



