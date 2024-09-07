<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index(){
        return view('admin.attendance-index', [
            'admin'     => Auth::user(),
        ]);
    }

    public function report(){
        return view('admin.attendance-report', [
            'admin'     => Auth::user(),
        ]);
    }
}
