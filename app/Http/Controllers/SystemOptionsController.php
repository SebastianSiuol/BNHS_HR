<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SystemOptionsController extends Controller
{
    public function index()
    {
        $faculty_id = Auth::user()->id;
        $today = Carbon::now()->timezone('Asia/Manila');

        $full_name = Auth::user()->personal_information->generateFullName();
        $faculty_code = Auth::user()->faculty_code;

        return Inertia::render('Public/Redirect', [
            'fullName' => $full_name,
            'facultyCode' => $faculty_code,
        ]);
    }
}
