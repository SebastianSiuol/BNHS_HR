<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function create(string $token){
        return view('auth.new-password', ['token' => $token]);
    }

    public function store(Request $request){
        dd($request->all());
    }
}
