<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacultyApiController extends Controller
{
    // PublicAPI
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
            'sex'               => $faculty->personal_information->sex,
            'contact_number'    => $faculty->personal_information->contact_no,
            'employmentStatus'  => $faculty->employment_status->name,
            "teacherLevel"      => $faculty->school_position->title,
            'department'        => $faculty->designation->department->name,
            'roles'             => $faculty->roles->pluck('role_name'),
            ];
    }

    public function destroy(Request $request)
    {
        $faculty_code = $request->query('facultyCode');

        if (!$faculty_code) return response()->json(['message' => 'Faculty code not found'], 404);

        $user_id = Faculty::where('faculty_code', $faculty_code)->select('id')->get()->first();

        $deleted_count = DB::table('sessions')
            ->where('user_id', '=', $user_id->id)
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






    // PrivateAPI
    public function checkEmail(Request $request){
        $email = $request->get('email');

        $exists = Faculty::where('email', $email)->first() !== null;

        return response()->json(['doesEmailExists' => $exists]);
    }

    public function showFaculty(Request $request){
        $faculty = Faculty::where('id', $request->get('id'))->get()->first();

        return response()->json([
            'id' => $faculty->id,
            'faculty_code' => $faculty->faculty_code,
            'email' => $faculty->email,
            'date_of_joining' => $faculty->date_of_joining,
            'designation' =>
            ['id' => $faculty->designation_id,
            'name' => $faculty->designation->name,
                'department' => $faculty->designation->department->name
        ],
            'shift' => $faculty->shift->name,
            'personal_information' => [
                'id' =>  $faculty->personal_information->id,
                'first_name' => $faculty->personal_information->first_name,
                'middle_name' => $faculty->personal_information->middle_name,
                'last_name' => $faculty->personal_information->last_name,
                'name_extension' => $faculty->personal_information->name_extension->title,
                'place_of_birth' => $faculty->personal_information->place_of_birth,
                'date_of_birth' => $faculty->personal_information->date_of_birth,
                'sex' => $faculty->personal_information->sex,
                'civil_status' => $faculty->personal_information->civil_status->civil_status,
                'contact_number' => $faculty->personal_information->contact_no,
                'telephone_number' => $faculty->personal_information->telephone_no,
                'contact_person_name' => $faculty->personal_information->contact_person->name,
                'contact_person_number' => $faculty->personal_information->contact_person->contact_no,
            ],
            'addresses' => [
                'residential_id'                => $faculty->personal_information->residential_address->id,
                'residential_house_num'         => $faculty->personal_information->residential_address->house_block_no,
                'residential_street'            => $faculty->personal_information->residential_address->street,
                'residential_subdivision'       => $faculty->personal_information->residential_address->subdivision_village,
                'residential_barangay'          => $faculty->personal_information->residential_address->barangay,
                'residential_city'              => $faculty->personal_information->residential_address->city_municipality,
                'residential_province'          => $faculty->personal_information->residential_address->province,
                'residential_zip_code'          => $faculty->personal_information->residential_address->zip_code,
                'permanent_id'                  => $faculty->personal_information->permanent_address->id,
                'permanent_house_num'           => $faculty->personal_information->permanent_address->house_block_no,
                'permanent_street'              => $faculty->personal_information->permanent_address->street,
                'permanent_subdivision'         => $faculty->personal_information->permanent_address->subdivision_village,
                'permanent_barangay'            => $faculty->personal_information->permanent_address->barangay,
                'permanent_city'                => $faculty->personal_information->permanent_address->city_municipality,
                'permanent_province'            => $faculty->personal_information->permanent_address->province,
                'permanent_zip_code'            => $faculty->personal_information->permanent_address->zip_code,
            ]
        ]);
    }
    // PrivateAPI

}
