<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index() {
        $auth = Auth::user();

        return Inertia::render('Admin/Dashboard', compact('auth'));
    }

    public function index2() {
        return Inertia::render('Admin/Dashboard2');
    }
}
