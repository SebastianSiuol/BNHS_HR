<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceApiController extends Controller
{
    public function attendanceAction(Request $request)
    {

        $validated = $request->validate([
            'user_id' => 'required',
            'shift_time' => 'required',
            'post_time' => 'required',
            'action' => 'required'
        ]);


        $user_id = $validated['user_id'];
        $post_time = Carbon::parse($validated['post_time']);


        // Check if the user exists
        $faculty = Faculty::find($user_id);
        if (!$faculty) {
            return response()->json(['error' => 'User not found.'], 404);
        }


        // Check if a check-in exists for the current day
        $existingAttendance = Attendance::where('faculty_id', $user_id)
            ->whereDate('check_in', $post_time->toDateString())
            ->first();


        if ($existingAttendance) {
            return response()->json(['error' => 'Already checked-in for the current day!'], 400);
        }


        // Create a new attendance record
        $attendance = new Attendance();
        $attendance->faculty_id = $user_id;
        $attendance->check_in = $post_time;
        $attendance->status = 'present'; // Assuming status can be set to 'checked_in'
        $attendance->save();

        return response()->json(['message' => 'Check-in successful.', 'attendance' => $attendance], 201);

    }
}
