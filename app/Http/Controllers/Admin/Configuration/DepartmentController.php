<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Models\FacultyAccountInformation\Department;
use App\Models\FacultyAccountInformation\Designation;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::with(['designations' => ['faculties']])->paginate(5);

        return view('admin.configuration.department.index', [
            'admin' => Auth::user(),
            'departments' => $departments
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
        /* Validate First */
        $validated_data = $request->validate([
            'department_name' => ['required', 'string', 'max:255', 'unique:departments,name'],
            'designation' => ['required', 'array'],
            'designation.*' => ['required', 'string'],
        ],[
            'designation.*.required' => 'The designation fields is/are required.',
        ]);

        /* Assign and Save */
        $new_department = new Department();
        $new_department->name = $validated_data['department_name'];
        $new_department->save();

        foreach ($validated_data['designation'] as $designation_data) {
            $new_designation = new Designation([
                'name' => $designation_data,
            ]);

            $new_department->designations()->save($new_designation);
        }

        /* Redirect */
        return back();
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {

            $department->delete();
            return back()
                ->with('success', 'Department deleted successfully!');

        } catch (QueryException $e) {

            // Check if the error is related to a foreign key constraint
            if ($e->getCode() == '23000') {
                return back()->with('error', 'Cannot delete the department because there is an existing faculty account in the department.');
            }
            // For any other database-related errors, handle them here
            return back()->with('error', 'An error occurred while deleting the department. Please try again.');

        }
    }
}
