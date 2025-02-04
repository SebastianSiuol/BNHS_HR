<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Attendance;
use App\Models\Shift;
use Carbon\Carbon;

class AttendanceApiController extends Controller
{
    public function attendanceAction(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'id' => ['required', 'string'],
            'shiftTime' => ['required'],
            'postTime' => ['required'],
            'action' => ['required'],
        ]);


        $user_id = $validated['id'];
        $post_time = Carbon::parse($validated['postTime']);


        // Check if the user exists
        $faculty = Faculty::find($user_id);
        if (!$faculty) {
            return response()->json(['error' => 'User not found.'], 404);
        }


        // Check if a check-in exists for the current day
        $existingAttendance = Attendance::where('faculty_id', $user_id)
            ->whereDate('check_in', $post_time->toDateString())
            ->first();
        dd($existingAttendance);

        if ($existingAttendance) {
            return response()->json(['error' => 'Already checked-in for the current day!'], 400);
        }


        // Create a new attendance record
        $attendance = new Attendance();
        $attendance->faculty_id = $user_id;
        $attendance->check_in = $post_time;
        $attendance->status = 'present';
        $attendance->save();

        return response()->json(['message' => 'Check-in successful.', 'attendance' => $attendance], 201);
    }


    public function checkDailyFacultyAttendance($time_of_day)
    {
        $now = Carbon::now();
        $today = $now->toDateString(); // Get current date

        if ($time_of_day === 'noon') {
            $shiftName = 'morning';
        } elseif ($time_of_day === 'midnight') {
            $shiftName = 'afternoon';
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid time_of_day argument. Use "noon" or "midnight".'
            ], 400);
        }

        // Get the shift
        $shift = Shift::where('name', $shiftName)->first();

        if (!$shift) {
            return response()->json([
                'status' => 'error',
                'message' => "Shift '$shiftName' not found."
            ], 404);
        }

        // Get faculties assigned to this shift
        $faculties = $shift->faculties;
        $absentFaculties = [];

        foreach ($faculties as $faculty) {
            // Check if attendance exists for this faculty today
            $attendanceExists = Attendance::where('faculty_id', $faculty->id)
                ->whereDate('created_at', $today)
                ->exists();

            if (!$attendanceExists) {
                // Mark faculty as absent
                Attendance::create([
                    'faculty_id' => $faculty->id,
                    'check_in' => null,
                    'check_out' => null,
                    'status' => 'absent',
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
                $absentFaculties[] = $faculty->id;
            }
        }

        return response()->json([
            'status' => 'success',
            'shift' => $shiftName,
            'absent_faculties' => $absentFaculties
        ]);
    }
}
