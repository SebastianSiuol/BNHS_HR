<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index() {

        return Inertia::render('Admin/Dashboard');
    }

    public function index2() {
        return Inertia::render('Admin/Dashboard2');
    }
}
