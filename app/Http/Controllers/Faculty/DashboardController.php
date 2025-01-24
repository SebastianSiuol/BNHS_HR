<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){

        $full_name = Auth::user()->personal_information->generateFullName();
        $faculty_code = Auth::user()->faculty_code;
        return Inertia::render('Faculty/Dashboard', compact('full_name', 'faculty_code'));

    }
}
