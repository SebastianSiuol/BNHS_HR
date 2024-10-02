<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLeaveController extends Controller
{
    public function index(){
        return view('admin.leave.index', [
            'admin'     => Auth::user(),
            'leaves'    => Leave::all()
        ]);
    }

    public function create(){
        return view('admin.leave.create', [
            'admin'     => Auth::user(),
            'leaves'    => Leave::with('leave_types', 'faculty.personal_information')->get(),

        ]);
    }
}
