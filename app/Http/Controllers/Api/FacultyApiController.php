<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacultyApiController extends Controller
{
    public function retrieveAFaculty(Request $request){

        $faculty = Faculty::where('faculty_code', $request->faculty)->get()->first();

        return response()->json(
            $this->jsonFormat($faculty)
        );
    }

    /**
     * Old API
     */
    public function index()
    {

        $retrieved_faculties = $this->retrieveFaculties();

        if ($retrieved_faculties == null) {
            return response()->json(['message' => 'There are no faculties found'], 404);
        }

        return response()->json([$retrieved_faculties]);
    }


    /**
     * Version 05
     */
    public function v5()
    {
        $retrieved_faculties = $this->retrieveFaculties();

        if ($retrieved_faculties == null) {
            $message = 'There are no faculties found';
            return response()->json(['message' => $message], 404);
        }

        $message = 'Faculties retrieved successfully';

        return response()->json([
            'message' => $message,
            'faculties' => $retrieved_faculties]);
    }

    /**
     * Retrieve faculties and returns them.
     */
    public function retrieveFaculties(){
        $faculties = Faculty::all();

        $array_of_faculties = [];

        if (!$faculties->isEmpty()) {

            foreach ($faculties as $faculty) {
                $array_of_faculties[] = $this->jsonFormat($faculty);
            }
            return $array_of_faculties;
        }

        return null;
    }

    public function jsonFormat($faculty){
        return [
            'id'                => $faculty->id,
            'faculty_code'      => $faculty->faculty_code,
            'email'             => $faculty->email,
            'first_name'        => $faculty->personal_information->first_name,
            'middle_name'       => $faculty->personal_information->middle_name,
            'last_name'         => $faculty->personal_information->last_name,
            'contact_number'    => $faculty->personal_information->contact_no,
            'employmentStatus'  => $faculty->employment_status->name,
            "teacherLevel"      => $faculty->school_position->title,
            'department'        => $faculty->designation->department->name,
            'roles'             => $faculty->roles->pluck('role_name'),
            ];
    }

    public function destroy(Request $request)
    {
        $deleted_count = DB::table('sessions')
            ->where('user_id', '=', $request->id)
            ->delete();

        if ($deleted_count > 0) {
            return response()->json([
                'message' => 'Logged out successfully.',
            ], 200);
        } else {
            return response()->json([
                'message' => 'No session found for the given user ID.',
            ], 404);
        }
    }
}
