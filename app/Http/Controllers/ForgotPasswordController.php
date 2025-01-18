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
    public function create(){
        return Inertia::render('Public/Auth/ForgotPassword');
    }

    public function store(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email',
        ]);

        // Generate a password reset token
        $status = Password::createToken(
            $faculty = Faculty::where('email', $request->email)->first()
        );

        if (!$status) {
            return response()->json(['message' => 'Failed to generate reset token'], 500);
        }

        // Password reset link (adjust your frontend link accordingly)
        $resetLink = url("/reset-password?token=$status&email=" . urlencode($faculty->email));

        // API request payload
        $payload = [
            "to" => $faculty->email,
            "subject" => "Reset Password Notification",
            "text" => "Hello,\n\nPlease use the following link to reset your password:\n\n$resetLink\n\nIf you did not request a password reset, please ignore this email.",
        ];

        // Send the email using the provided API
        $response = Http::post('https://bhnhs-sis-api-v1.onrender.com/api/v1/sis/send-email', $payload);

        // Handle the response
        if ($response->successful()) {
            return redirect()->back()->with(['message' => 'Password reset email sent successfully.']);
        }

        return redirect()->back()->with(['message' => 'Failed to send email. Please try again later.']);
    }
}
