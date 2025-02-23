<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use App\Models\Faculty;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;
use App\Mail\FacultyResetPasswordLink;

class ForgotPasswordController extends Controller
{

    public function create()
    {
        return Inertia::render('Public/Auth/ForgotPassword');
    }

    public function store(Request $request)
    {


        // Validate the email input
        $request->validate([
            'email' => 'required|email',
        ]);

        // Retrieve the faculty based on the email
        $faculty = Faculty::where('email', $request->email)->first();

        if ($faculty) {
            // Generate a password reset token
            $token = Password::createToken($faculty);

            if ($token) {
                $resetLink = url("/reset-password/?token=$token&email=" . urlencode($faculty->email));

                $payload = [
                    "reset_url" => $resetLink,
                ];

                Mail::to($faculty->email)->send(new FacultyResetPasswordLink($payload));
            }
        }

        return redirect()->back()->with(['message' => 'If the email exists, the email is sent.']);
    }
}
