<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {

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

        return Inertia::render('Faculty/Dashboard', [
            'full_name' => $full_name,
            'faculty_code' => $faculty_code,
            'announcements' => $mappedAnnouncements
        ]);
    }
}
