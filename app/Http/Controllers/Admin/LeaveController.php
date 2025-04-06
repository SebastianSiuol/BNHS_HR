<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

// Models
use App\Models\Leave;
use App\Models\LeaveType;

class LeaveController extends Controller
{
    public function index(Request $request)
    {

        $user_leaves = Leave::where('faculty_id', Auth::user()->id)
            ->select('public_id','start_date', 'end_date', 'status', 'document', 'leave_types_id')
            ->with(['leave_types' => fn($query) => $query->select('id', 'name', 'days')])
            ->paginate(5);

        $service_credit = Auth::user()->service_credit;

        $render_url = $this->getRenderUrl($request, [
            'admin' => 'Admin/Leave/Index',
            'faculty' => 'Faculty/Leave/Index',
        ]);

        return Inertia::render($render_url, [
            'leaves' => $user_leaves,
            'serviceCredit' => $service_credit,
        ]);
    }

    public function show($leave_id)
    {
        $leave = Leave::where('public_id', $leave_id)->first();

        if (!$leave) {
            return response()->json(['error' => 'Leave not found'], 404);
        }

        $file_url = null;

        if ($leave->document && Storage::disk('public')->exists($leave->document)) {
            $file_url = Storage::disk('public')->url($leave->document);
        }

        $leaveDetails = [
            'publicId' => $leave->public_id,
            'startDate' => $leave->start_date,
            'endDate' => $leave->end_date,
            'document' => $file_url, // could be null
            'status' => $leave->status,
        ];

        return response()->json($leaveDetails);
    }

    public function create(Request $request)
    {
        if (Leave::isThereLeaveActive()) {

            return redirect()->back()->with('error', 'You currently have an active request!');
        }

        $auth_sex = Auth::user()->personal_information->sex;


        $leave_types = LeaveType::all()->select('public_id', 'name', 'days', 'for', 'is_service_credits');
        $service_credit = Auth::user()->service_credit;


        $render_url = $this->getRenderUrl($request, [
            'admin' => 'Admin/Leave/Create',
            'faculty' => 'Faculty/Leave/Create',
        ]);

        return Inertia::render($render_url, [
            'authSex' => $auth_sex,
            'leaveTypes' => $leave_types,
            'serviceCredit' => $service_credit,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate(['leave_type' => 'required']);

        $leave_type = LeaveType::where('public_id', $request->leave_type)->firstOrFail();

        $validate_request = [
            'leave_type' => ['required'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
        ];

        // Only require the document if needed (customize this as per business logic)
        if ($request->hasFile('leave_document')) {
            $validate_request['leave_document'] = ['file'];
        }

        if (!$leave_type->days) {
            $validate_request['no_of_days'] = ['required', 'gt:0'];
        }

        $validated_input = $request->validate($validate_request, [
            'start_date.after_or_equal' => 'The From* date cannot be an earlier day than today!',
        ]);

        try {
            DB::beginTransaction();

            $end_date = LeaveType::calculateLeaveEndDate(
                $validated_input['start_date'],
                $leave_type->days ?? $validated_input['no_of_days']
            );

            $user = Auth::user();
            $public_user_id = $user->public_id;

            $leave_document_path = null;

            if ($request->hasFile('leave_document')) {
                $leave_document = $request->file('leave_document');
                $leave_document_path = $leave_document->store('/leave_documents/' . $public_user_id . '/', 'public');
            }

            Leave::create([
                'faculty_id' => $user->id,
                'leave_types_id' => $leave_type->id,
                'start_date' => $validated_input['start_date'],
                'end_date' => $end_date,
                'document' => $leave_document_path,
                'service_credits_used' => $request->service_credits_used,
            ]);

            if (isset($request->user_service_credits)) {
                $user->service_credit = $request->user_service_credits;
                $user->save();
            }

            DB::commit();

            $render_url = $this->getRenderUrl($request, [
                'admin' => 'admin.leaves.index',
                'faculty' => 'faculty.leaves.index',
            ], true);

            return redirect($render_url)->with('success', 'Leave request added successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Leave request failed: ' . $e->getMessage(), [
                'request' => $request->all(),
                'user_id' => Auth::id()
            ]);

            return back()->withErrors('Something went wrong while processing your leave request. Please try again.');
        }
    }

    public function cancel(Request $request, $leave_id)
    {
        $request->validate([
            'action' => 'required|in:cancel',
        ]);

        $leave = Leave::where('public_id', $leave_id)->first();

        if (!$leave) {
            return redirect()->back()->with('error', 'Leave not found.');
        }

        if ($leave->status !== 'pending') {
            return redirect()->back()->with('error', 'Cannot cancel leave. Only pending requests can be cancelled.');
        }

        try {
            DB::beginTransaction();

            // Restore service credit if service_credits_used was recorded
            if (!is_null($leave->service_credits_used)) {
                $user = $leave->faculty; // assumes 'faculty' relationship exists on Leave model
                if ($user) {
                    $user->service_credit += $leave->service_credits_used;
                    $user->save();
                }
            }

            $leave->status = 'cancelled';
            $leave->save();

            DB::commit();

            return redirect()->back()->with('success', 'Leave request cancelled successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Leave cancellation failed: ' . $e->getMessage(), [
                'leave_id' => $leave_id,
                'user_id' => Auth::id(),
            ]);

            return redirect()->back()->with('error', 'Something went wrong while cancelling the leave request.');
        }
    }


    public function manage()
    {

        $auth_faculty = Auth::user();
        $auth_department_id = $auth_faculty->designation->department_id;
        $auth_faculty_roles = $auth_faculty->roles->pluck('role_name');

        $leaveQuery = Leave::select('id', 'public_id', 'leave_types_id', 'faculty_id', 'start_date', 'end_date', 'document', 'status')
            ->with([
                'faculty' => fn($query) => $query->select('id', 'faculty_code', 'service_credit')
                    ->with(['personal_information' => fn($subQuery) => $subQuery->select('id', 'faculty_id', 'first_name', 'last_name')]),
                'leave_types' => fn($query) => $query->select('id', 'name')
            ]);

            if ($auth_faculty_roles->contains('hr_manager')) {
                $leaveQuery->whereHas('faculty.designation.department', fn($query) => $query->where('id', $auth_department_id));
            }

            $leaves_requests = $leaveQuery->paginate(5);

        return Inertia::render('Admin/Leave/Manage', [
            'leaveRequests' => $leaves_requests,
        ]);
    }


    public function leaveAction(Request $request, Leave $leave)
    {
        // Validate the request action
        $request->validate([
            'action' => 'required|in:approve,reject,cancel',
        ]);

        // Perform the requested action
        if ($request->action === 'approve') {
            if ($leave->status === 'approved') {
                return redirect()->route('admin.leaves.manage')->withErrors(['error' => 'This leave request is already approved.']);
            }
            $leave->status = 'approved';
            $message = 'Leave approved successfully!';
        } elseif ($request->action === 'reject') {
            if ($leave->status === 'rejected') {
                return redirect()->route('admin.leaves.manage')->withErrors(['error' => 'This leave request is already rejected.']);
            }
            $leave->status = 'rejected';
            $message = 'Leave rejected successfully!';
        } elseif ($request->action === 'cancel') {
            if ($leave->status === 'cancelled') {
                return redirect()->route('admin.leaves.index')->withErrors(['error' => 'This leave request is already cancelled.']);
            }
            $leave->status = 'cancelled';
            $message = 'Leave cancelled successfully!';
        } else {
            return redirect()->route('admin.leaves.manage')->withErrors(['error' => 'Invalid action specified.']);
        }

        // Save the leave status
        $leave->save();

        // Redirect with success message
        return redirect()->route('admin.leaves.manage')->with(['success' => $message]);
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
