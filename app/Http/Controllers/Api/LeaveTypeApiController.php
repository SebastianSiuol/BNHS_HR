<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeApiController extends Controller
{
    public function getLeaveType(Request $request){
        return response()->json(LeaveType::find($request->id));
    }
}
