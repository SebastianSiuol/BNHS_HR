<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyApiController extends Controller
{
    public function index(Request $request)
    {
        $retrieved_faculties = Faculty::all();

        if ($retrieved_faculties->isEmpty()) {
            return response()->json(['error' => 'There are no faculties found'], 404);
        }

        foreach ($retrieved_faculties as $retrieved_faculty) {
            $array_of_faculties[] = [
                'faculty_code' => $retrieved_faculty->faculty_code,
                'email' => $retrieved_faculty->email,
                'first_name' => $retrieved_faculty->personal_information->first_name,
                'middle_name' => $retrieved_faculty->personal_information->middle_name,
                'last_name' => $retrieved_faculty->personal_information->last_name,
                'contact_number' => $retrieved_faculty->personal_information->contact_no,
                'employmentStatus' => $retrieved_faculty->employment_status->name,
                "teacherLevel" => $retrieved_faculty->school_position->name,
                'department' => $retrieved_faculty->designation->department->name,
                'roles' => $retrieved_faculty->roles->pluck('role_name'),
            ];
        }

        return response()->json($array_of_faculties);
    }
}
