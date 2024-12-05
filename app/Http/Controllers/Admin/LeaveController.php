<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index(){
        return Inertia::render('Admin/Leave/Index');
    }

    public function create (){
        return Inertia::render('Admin/Leave/Create');
    }


    public function store(Request $request){
        return Inertia::render('Admin/Leave/Index');
    }
}
