<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Carbon\Carbon;
use App\Models\Attendance;

class AttendanceController extends Controller
{

    public function create()
    {
        $faculty_id = Auth::user()->id;
        $shift_id = Auth::user()->shift_id;

        $today = Carbon::now()->timezone('Asia/Manila');

        $attendance = Attendance::where('faculty_id', $faculty_id)
            ->whereDate('created_at', $today)
            ->first();


        $shift = Shift::where('id', $shift_id)
            ->select('name', 'from', 'to')
            ->first();


        return Inertia::render('Faculty/Attendance/Create', [
            'shift' => $shift,
            'attendance' => $attendance,

        ]);
    }

    public function checkIn(Request $request)
    {
        return $this->handleAttendance($request, 'check_in');
    }

    public function checkOut(Request $request)
    {
        return $this->handleAttendance($request, 'check_out');
    }

    public function handleAttendance(Request $request, $type)
    {
        $validated = $this->validateRequest($request);
        $user_id = $validated['id'];
        $post_time = Carbon::parse($validated['postTime']);

        $faculty = Faculty::find($user_id);
        if (!$faculty) {
            return $this->redirectWithError('User not found.', 404);
        }

        $shift = $faculty->shift; // Assuming the faculty model has a relationship with the shift.
        if (!$shift) {
            return $this->redirectWithError('Shift not found for the user.', 404);
        }

        $shift_start = Carbon::parse($shift->from);
        $shift_end = Carbon::parse($shift->to);

        $attendance = Attendance::where('faculty_id', $user_id)
            ->whereDate('created_at', $post_time->toDateString())
            ->first();

        if ($type == 'check_in') {
            if ($attendance) {
                // If marked absent, update it for the current check-in
                if ($attendance->status === 'absent') {
                    $attendance->check_in = $post_time;
                    $attendance->status = $post_time->greaterThan($shift_start) ? 'late' : 'present';
                    $attendance->save();

                    return $this->redirectWithMessage("Absence overridden with check-in.", $attendance, 200);
                }

                return $this->redirectWithError("Already checked in for the day!", 400);
            }

            // If no attendance exists, create a new record
            $attendance = new Attendance();
            $attendance->faculty_id = $user_id;
            $attendance->check_in = $post_time;
            $attendance->status = $post_time->greaterThan($shift_start) ? 'late' : 'present';
            $attendance->save();

            return $this->redirectWithMessage($type, $attendance, 201);
        }

        if ($type == 'check_out') {
            if (!$attendance) {
                return $this->redirectWithError("No check-in record found for today!", 400);
            }

            if ($attendance->check_out) {
                return $this->redirectWithError("Already checked out for the day!", 400);
            }

            $attendance->check_out = $post_time;

            // Ensure the attendance status is updated properly if the shift has ended
            if ($attendance->status === 'absent') {
                $attendance->status = 'not_timed_out'; // Status to reflect a partial record
            }

            $attendance->save();

            return $this->redirectWithMessage($type, $attendance, 201);
        }

        return $this->redirectWithError("Invalid operation type.", 400);
    }


    private function validateRequest(Request $request)
    {
        return $request->validate([
            'id' => ['required'],
            'shiftTime' => ['required'],
            'postTime' => ['required'],
            'action' => ['required'],
        ]);
    }

    private function redirectWithError($message, $status)
    {
        return redirect()->back()->with(['error' => $message], $status);
    }

    private function redirectWithMessage($type, $attendance, $status)
    {

        switch (strtolower($type)) {
            case 'check_in':
                $message = 'Check-in successful!';
                break;
            case 'check_out':
                $message = 'Check-out successful!';
                break;
            default:
                $message = 'Invalid action!';
        }

        return redirect()->back()->with(['message' => $message, 'attendance' => $attendance], $status);
    }
}
