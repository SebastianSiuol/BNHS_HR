<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class FacultyController extends Controller
{
    public function create(){
        return Inertia::render('Admin/Faculty/Create');
    }
}
