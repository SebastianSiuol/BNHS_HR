<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){

        $full_name = Auth::user()->personal_information->generateFullName();
        return Inertia::render('Faculty/Dashboard', compact('full_name'));

    }
}
