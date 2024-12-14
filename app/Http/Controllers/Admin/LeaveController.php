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
    public function index(Request $request)
    {

        $user_leaves = Leave::where('faculty_id', Auth::user()->id)
            ->select('id', 'start_date', 'leave_date', 'reason', 'status', 'leave_types_id')
            ->with(['leave_types' => fn($query) => $query->select('id', 'name', 'days')])
            ->get();



        $render_url = $this->getRenderUrl($request, [
            'admin' => 'Admin/Leave/Index',
            'faculty' => 'Faculty/Leave/Index',
        ]);

        return Inertia::render($render_url, [
            'leaves' => $user_leaves,
        ]);
    }

    public function create(Request $request)
    {
        if (Leave::isThereLeaveActive()) {

            $render_url = $this->getRenderUrl($request, [
                'admin' => 'admin.leaves.index',
                'faculty' => 'faculty.leaves.index',
            ], true);

            return redirect($render_url)->with('error', 'You currently have an active request!');
        }


        $leave_types = LeaveType::all()->select('id', 'name', 'days');
        $service_credit = Auth::user()->service_credit;


        $render_url = $this->getRenderUrl($request, [
            'admin' => 'Admin/Leave/Create',
            'faculty' => 'Faculty/Leave/Create',
        ]);

        return Inertia::render($render_url, [
            'leaveTypes' => $leave_types,
            'serviceCredit' => $service_credit,
        ]);
    }


    public function store(Request $request)
    {

        /* Validates Leave Type before Proceeding. */
        $request->validate(['leave_type' => 'required']);

        /* Finds the Requested Leave to Retrieve its Days */
        $leave_type = LeaveType::findOrFail($request->leave_type);

        /* Validates Normal Requests */
        $validate_request = [
            'leave_type' => ['required'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'reason' => ['required'],
        ];

        /* If no days are found, validate the no_of_days input */
        if (!$leave_type->days) {
            $validate_request['no_of_days'] = ['required'];
        }

        $validated_input = $request->validate($validate_request, [
            'start_date.after_or_equal' => 'The From* date cannot be an earlier day than today!',
        ]);

        // Calculates Leave End Date
        $end_date = LeaveType::calculateLeaveEndDate(
            $validated_input['start_date'],
            $leave_type->days ?? $validated_input['no_of_days']
        );

        // Creates new Instance of Leave Model
        $leave = new Leave([
            'leave_types_id' => $validated_input['leave_type'],
            'start_date' => $validated_input['start_date'],
            'leave_date' => $end_date,
            'document' => "Document",
            'reason' => $validated_input['reason'],
        ]);

        // Assigns the instance of Leave to the Authenticated User and Save it.
        Auth::user()->leaves()->save($leave);

        $render_url = $this->getRenderUrl($request, [
            'admin' => 'admin.leaves.index',
            'faculty' => 'faculty.leaves.index',
        ], true);


        return redirect($render_url)->with('success', 'Leave request addded successfully!');
    }

    public function approve(){

        return Inertia::render('Admin/Leave/Approve');
    }

    private function getRenderUrl(Request $request, array $url_map, bool $use_route_format = false)
    {
        $url_request = strtolower($request->segment(1));
        if (array_key_exists($url_request, $url_map)) {
            return $use_route_format ? route($url_map[$url_request]) : $url_map[$url_request];
        }
        abort(404);
    }

}
