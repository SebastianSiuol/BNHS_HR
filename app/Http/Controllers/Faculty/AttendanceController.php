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

    public function index()
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


        return Inertia::render('Faculty/Attendance/Index', [
            'shift' => $shift,
            'attendance' => $attendance,

        ]);
    }

    public function checkIn(Request $request)
    {
        return $this->handleAttendance($request, 'checkIn');
    }

    public function checkOut(Request $request)
    {
        return $this->handleAttendance($request, 'checkOut');
    }

    public function handleAttendance(Request $request, $type)
    {
        $this->validateRequest($request);

        $faculty_id = $request->id;
        $post_time = Carbon::parse($request->postTime);

        $today = Carbon::today();

        $faculty = Faculty::find($faculty_id);

        $shift = $faculty->shift;
        if (!$shift) {
            return redirect()->back()->with(['error' => 'Shift not found for the user.'], 404);
        }

        $shift_start = Carbon::parse($shift->from)->setDate($today->year, $today->month, $today->day);
        $shift_end = Carbon::parse($shift->to)->setDate($today->year, $today->month, $today->day);


        $attendance = Attendance::where('faculty_id', $faculty_id)
            ->whereDate('created_at', $post_time->toDateString())
            ->first();

        if ($type == 'checkIn') {
            if ($attendance) {
                // If marked absent, update it for the current check-in
                if ($attendance->status === 'absent') {
                    $attendance->check_in = $post_time;
                    $attendance->status = $post_time->greaterThan($shift_start) ? 'late' : 'present';
                    $attendance->save();

                    return redirect()->back()->with(['message' => 'Absence overridden with check-in.'], 200);
                }

                return $this->redirectWithError("Already checked in for the day!", 400);
            }

            // If no attendance exists, create a new record
            $attendance = new Attendance();
            $attendance->faculty_id = $faculty_id;
            $attendance->check_in = $post_time;
            $attendance->status = $post_time->greaterThan($shift_start) ? 'late' : 'present';
            $attendance->save();

            return $this->redirectWithMessage($type, 201);
        }

        if ($type == 'checkOut') {
            if ((!$attendance) || (!$attendance->check_in && $attendance->status === 'absent')) {
                return $this->redirectWithError("You have not checked-in yet!", 400);
            }

            if ($attendance->check_out) {
                return $this->redirectWithError("Already checked out for the day!", 400);
            }

            $attendance->check_out = $post_time;
            $attendance->save();

            return $this->redirectWithMessage($type, 201);
        }

        return $this->redirectWithError("Invalid operation type.", 400);
    }

    private function redirectWithError($message, $status)
    {
        return redirect()->back()->with(['error' => $message], $status);
    }

    private function redirectWithMessage($type, $status)
    {

        switch (strtolower($type)) {
            case 'checkin':
                $message = 'Check-in successful!';
                break;
            case 'checkout':
                $message = 'Check-out successful!';
                break;
            default:
                $message = 'Invalid action!';
        }

        return redirect()->back()->with(['message' => $message], $status);
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
}
