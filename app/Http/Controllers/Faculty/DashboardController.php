<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $faculty_id = Auth::user()->id;
        $today = Carbon::now()->timezone('Asia/Manila');

        $full_name = Auth::user()->personal_information->generateFullName();
        $faculty_code = Auth::user()->faculty_code;
        $announcements = Announcement::latest()->take(3)->get();

        $mappedAnnouncements = $announcements->map(function ($annc){
            return [
                'id' => $annc->id,
                'title' => $annc->title,
                'description' => $annc->description,
                'fileUrl' => $annc->announcement_file ? Storage::disk('public')->url($annc->announcement_file) : null,
                'createdAt' => $annc->created_at,
            ];
        });

        $attendance = Attendance::where('faculty_id', $faculty_id)
            ->whereDate('created_at', $today)
            ->select('status')
            ->first();

        return Inertia::render('Faculty/Dashboard', [
            'fullName' => $full_name,
            'facultyCode' => $faculty_code,
            'announcements' => $mappedAnnouncements,
            'attendance' => $attendance,
        ]);
    }
}
