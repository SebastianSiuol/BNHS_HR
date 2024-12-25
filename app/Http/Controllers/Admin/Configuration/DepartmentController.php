<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Models\FacultyAccountInformation\Department;
use App\Models\FacultyAccountInformation\Designation;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $departments = Department::select('id', 'name')
        ->with([
            'designations' => function($query) {
                $query->select('id', 'name', 'department_id');
            }
        ])
        ->withCount([
            'designations as faculties_count' => function ($query) {
                $query->join('faculties', 'designations.id', '=', 'faculties.designation_id')
                      ->selectRaw('COUNT(faculties.id)');
            }
        ])
        ->paginate(5);

        return Inertia::render('Admin/Config/Department/Index', [
            'departments' => $departments
        ]);
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
        return redirect()->route('admin.config.department.index')->with('success', 'Department added successfully');;
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
    try {
        // Validate input data
        $validated = $request->validate([
            'department_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'name')->ignore($department->id),
            ],
            'designations' => 'array',
            'designations.*.id' => 'nullable|exists:designations,id',
            'designations.*.name' => 'required|string|max:255',
        ]);

        // Perform operations in a database transaction
        DB::transaction(function () use ($validated, $department) {
            // Update department name
            $department->update(['name' => $validated['department_name']]);

            // Process designations
            $designations = collect($validated['designations']);
            $existingIds = $designations->pluck('id')->filter(); // Only include non-null IDs

            // Delete removed designations
            $department->designations()->whereNotIn('id', $existingIds)->delete();

            // Update existing or create new designations
            foreach ($designations as $designation) {
                $department->designations()->updateOrCreate(
                    ['id' => $designation['id'] ?? null], // Match by ID if available
                    ['name' => $designation['name']]
                );
            }
        });

        // Redirect with success message
        return to_route('admin.config.department.index')
            ->with('success', 'Department updated successfully.');
    } catch (ValidationException $e) {
        // Handle validation errors
        return back()->withErrors($e->errors())
            ->withInput(); // Preserve input for correction
    } catch (\Throwable $e) {
        // Log unexpected errors for debugging
        \Log::error('Department update failed', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        // Redirect with error message
        return to_route('admin.config.department.index')
            ->with('error', 'An unexpected error occurred while updating the department.');
    }
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
