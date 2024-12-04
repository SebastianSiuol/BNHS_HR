<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Retrieves all faculties with certain columns
     */
    public function index(Request $request)
    {

    }

//    TODO: Integrate this code if API functions are neeed
//Route::get('/get-response', function(){
//
//    $response = Http::withHeaders([
//        'x-api-key' => 'Ru8NWgJalpjcZ1T53i10Z5Jp4xdQoKdU90dq8zLHC1ZrGMxwbl4XToKg0sb7JCv9'
//    ])->get('https://bnhs-hr.onrender.com/api/retrieve/faculty', [
//        'faculty_code' => 'BHNHS-2024-0001'
//    ]);
//
//    dd($response->getbody());
//
//});


//    TODO: Add first-name, middle-name, last-name
//    public function register(Request $request)
//    {
//        //Validates registration credentials
//        $validatedFaculty = Validator::make($request->all(), [
//            'name' => 'required|min:3|max:64',
//            'email' => 'required|email|unique:faculties|max:255',
//            'password' => 'required|min:8|max:32',
//        ]);
//
//        //Response if Validation fails
//        if ($validatedFaculty->fails()) {
//            return response()->json([
//                'status' => true,
//                'message' => 'Factory registration failed',
//            ], 401);
//        }
//
//        //Creates user if validations are successful
//        $faculty = Faculty::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => $request->password,
//        ]);
//
//
//        //Returns a response for successful registration
//        return response()->json([
//            'status' => true,
//            'message' => 'User registered successfully',
//            'token' => $faculty->createToken('apiToken')->plainTextToken
//        ]);
//    }

    public function login(Request $request)
    {
        $validatedUser = Validator::make($request->all(), [
            'code' => 'required',
            'password' => 'required|min:8|max:32',

        ]);

        //Response if Validation fails
        if ($validatedUser->fails()) {
            return response()->json([
                'message' => 'Log-in failed'
            ], 401);
        }

        // Check if the user is already logged in
        $user = Faculty::where('faculty_code', $request->code)->first();

        if ($user && $user->tokens()->exists()) {
            return response()->json([
                'message' => 'User is already logged in!',
            ], 401);
        }

        //Authenticates the user, fails if there are no corresponding credentials found.
        if (!Auth::attempt(['faculty_code' => $request['code'], 'password' => $request['password']])) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        //Returns response
        $user = Faculty::where('faculty_code', $request->code)->first();

        return response()->json([
            'message' => 'User log-in successfully',
            'token' => $user->createToken('apiToken')->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $userName = $request->user()->first_name . ' ' . $request->user()->last_name;

        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => "$userName logged out",
        ]);

    }

}



