<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'title' => ['required', 'max:50'],
            'description' => ['required', 'max:255'],
            'announcement_document' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        $announcement_file = $request->file('announcement_document');
        $announce_file_path = null;

        if ($announcement_file) {
            $announce_file_path = $announcement_file->store('/announcements', 'public');
        }

        $announcement = new Announcement;
        $announcement->title = $request->title;
        $announcement->description = $request->description;
        $announcement->announcement_file = $announce_file_path;
        $announcement->save();

        return redirect()->back()->with(['success' => 'Announcement published successfully!']);
    }


    public function destroy(Request $request, $id){

        $announcement = Announcement::find($id);
        $announcement->delete();

        return redirect()->back()->with(['error' => 'Announcement deleted successfully!']);
    }

}
