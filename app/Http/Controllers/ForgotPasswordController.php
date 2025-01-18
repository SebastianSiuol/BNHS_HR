<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use App\Models\Faculty;
use Inertia\Inertia;


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
                // Password reset link (adjust your frontend link accordingly)
                $resetLink = url("/reset-password/?token=$token&email=" . urlencode($faculty->email));

                // API request payload
                $payload = [
                    "to" => $faculty->email,
                    "subject" => "Reset Password Notification",
                    "text" => "Hello,\n\nPlease use the following link to reset your password:\n\n$resetLink\n\nIf you did not request a password reset, please ignore this email.",
                ];

                // Send the email using the provided API
                Http::post('https://bhnhs-sis-api-v1.onrender.com/api/v1/sis/send-email', $payload);
            }
        }

        return redirect()->back()->with(['message' => 'If the email exists, the email is sent.']);
    }
}
