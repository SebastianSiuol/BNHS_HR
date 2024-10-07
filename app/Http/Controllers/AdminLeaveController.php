<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLeaveController extends Controller
{
    public function index(){

        $admin    = Auth::user();

        $all_leave_requests = Leave::all();


        $approved_requests = Leave::where('status', 'approved')->get();
        $rejected_requests = Leave::where('status', 'rejected')->get();
        $pending_requests = Leave::where('status', 'pending')->get();

        $max_rows = max($approved_requests->count(), $rejected_requests->count(), $pending_requests->count());

        return view('admin.leave.index', compact(
            'all_leave_requests',
            'approved_requests',
            'rejected_requests',
            'pending_requests',
            'max_rows',
            'admin',
        ));
    }

    public function create(){
        return view('admin.leave.create', [
            'admin'     => Auth::user(),
            'leaves'    => Leave::all(),

        ]);
    }

    public function statusAction(Request $request){

        $leave = Leave::find($request->leave_id);

        if($request->action == 'approve'){
            $leave->status = 'approved';
        } else if ($request->action == 'reject'){
            $leave->status = 'rejected';
        }

        $leave->save();

        return response()->json([
            'status' => 200,
            'redirect_url' => route('admin.leaves.create'),
        ]);
    }
}
