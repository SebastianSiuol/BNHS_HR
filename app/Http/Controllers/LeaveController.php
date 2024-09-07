<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index(){
        return view('admin.leave-index', [
            'admin'     => Auth::user(),
        ]);
    }

    public function create(){
        return view('admin.leave-create', [
            'admin'     => Auth::user(),
        ]);
    }
}
