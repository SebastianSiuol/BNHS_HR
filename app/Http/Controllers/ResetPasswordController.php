<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\Faculty;
use Inertia\Inertia;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function create(Request $request){

        return Inertia::render('Public/Auth/ResetPassword', [
            'token' => $request->token,
            'email' => $request->email
        ]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);


        // Check if the token and email are valid
        $faculty = Faculty::where('email', $request->email)->first();

        if (!$faculty || !Password::tokenExists($faculty, $request->token)) {
            return redirect()->back()->with(['error' => 'Invalid token or email'], 400);
        }

        if (!Password::tokenExists($faculty, $request->token)) {
            return redirect()->back()->with(['error' => 'Invalid token or email'], 400);
        }

        Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Faculty $faculty, string $password) {
                $faculty->forceFill([
                    'password' => Hash::make($password)
                ]);

                $faculty->save();

            }
        );

        // Invalidate the token
        Password::deleteToken($faculty);

        return redirect()->route('login.create')->withErrors(['message' => 'Password has been reset successfully.']);
    }
}
