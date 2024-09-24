<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\FacultyAccountInformation\Department;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $faculties = Faculty::with('personal_information')->paginate(5);

        if($request->has('department') || $request->has('shift') || $request->has('attendance_date')) {

            if(request('department') || request('shift')) {

                $faculties = Faculty::with('department', 'shift')
                    ->whereHas('department', function ($query) use($request) {
                        $query->where('department_id', $request->get('department'));
                    })
                    ->orWhereHas('shift', function ($query) use($request) {
                        $query->where('shift_id', $request->get('shift'));
                    })
                    ->paginate(5);
            }

        }
//        dd($faculties->isEmpty());

        return view('admin.attendance.index', [
            'admin'     => Auth::user(),
            'faculties' => $faculties,
            'departments' => Department::all(),
            'shifts'    => Shift::all(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function report(){
        return view('admin.attendance.report', [
            'admin'     => Auth::user(),
            'faculties'  => Faculty::all()->first()->paginate(5)
        ]);
    }

}
