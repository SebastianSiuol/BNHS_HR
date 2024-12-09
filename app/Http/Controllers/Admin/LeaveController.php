<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Leave;

class LeaveController extends Controller
{
    public function index(){
        $user_leaves = Leave::where('faculty_id', Auth::user()->id)
        ->select('id', 'start_date', 'leave_date', 'reason','status', 'leave_types_id')
        ->with(['leave_types'=> fn($query) => $query->select('id','name', 'days') ])
        ->get();

        return Inertia::render('Admin/Leave/Index',[
            'leaves' => $user_leaves,
        ]);
    }

    public function create (){
        $leave_types = LeaveType::all()->select('id', 'name', 'days');

        $service_credit = Auth::user()->service_credit;


        return Inertia::render('Admin/Leave/Create', [
            'leaveTypes' => $leave_types,
            'serviceCredit' => $service_credit,
        ]);
    }


    public function store(Request $request){

        /* Validates Leave Type before Proceeding. */
        $request->validate([
            'leave_type' => 'required', 'abort',
        ]);

        /* Finds the Requested Leave to Retrieve its Days */
        $leave_type = LeaveType::find($request->leave_type);

        /* Validates Input depending on the Requested Leave Type */
        if ($leave_type->days) {

            $validated_input = $request->validate([
                'leave_type' => ['required'],
                'start_date' => ['required', 'date', 'after_or_equal:-1 day'],
                'reason' => ['required'],
            ], [
                'start_date.after_or_equal' => 'The From* date cannot be an earlier day than today!',
            ]);

            $end_date = LeaveType::calculateLeaveEndDate($validated_input['start_date'], $leave_type->days);

        } else {
            $validated_input = $request->validate([
                'leave_type' => ['required'],
                'start_date' => ['required', 'date', 'after_or_equal:-1 day'],
                'no_of_days' => ['required'],
                'reason' => ['required'],
            ], [
                'start_date.after_or_equal' => 'The From* date cannot be an earlier day than today!',
            ]);

            $end_date = LeaveType::calculateLeaveEndDate($validated_input['start_date'], $validated_input['no_of_days']);

        };

        $user = Auth::user();

        $leave = new Leave([
            'leave_types_id' => $validated_input['leave_type'],
            'start_date' => $validated_input['start_date'],
            'leave_date' => $end_date,
            'document' => "Document",
            'reason' => $validated_input['reason'],
        ]);

        $user->leaves()->save($leave);

        return redirect()
            ->route('admin.leaves.index')
            ->with('success', 'Leave request addded successfully!');
    }
}
