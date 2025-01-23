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
            'id'                => $faculty->id ?? "N/A",
            'faculty_code'      => $faculty->faculty_code ?? "N/A",
            'email'             => $faculty->email ?? "N/A",
            'first_name'        => $faculty->personal_information->first_name ?? "N/A",
            'middle_name'       => $faculty->personal_information->middle_name ?? "N/A",
            'last_name'         => $faculty->personal_information->last_name ?? "N/A",
            'sex'               => $faculty->personal_information->sex ?? "N/A",
            'contact_number'    => $faculty->personal_information->contact_no ?? "N/A",
            'employmentStatus'  => $faculty->employment_status->name ?? "N/A",
            "teacherLevel"      => $faculty->school_position->title ?? "N/A",
            'department'        => $faculty->designation->department->name ?? "N/A",
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
        $faculty = Faculty::where('id', $request->get('id'))->first();

        $department_head = null;


        // Check if the department_head_id is not null
        if ($faculty && $faculty->department_head_id) {
            $department_head = Faculty::select('id')
                ->where('id', $faculty->department_head_id) // Add where clause
                ->with([
                    'personal_information' => fn($query) => $query->select('faculty_id', 'first_name', 'last_name')
                ])
                ->first(); // Fetch the first result
        }

        return response()->json([
            'id' => $faculty->id ?? "N/A",
            'faculty_code' => $faculty->faculty_code ?? "N/A",
            'email' => $faculty->email ?? "N/A",
            'date_of_joining' => $faculty->date_of_joining ?? "N/A",
            'department_head' => $department_head,
            'designation' =>
                [
                    'id' => $faculty->designation_id ?? "N/A",
                    'name' => $faculty->designation->name ?? "N/A",
                    'department' => $faculty->designation->department->name ?? "N/A"
                ],
            'shift' => $faculty->shift->name ?? "N/A",
            'personal_information' =>  [
                'id' => $faculty->personal_information->id ?? "N/A",
                'first_name' => $faculty->personal_information->first_name ?? "N/A",
                'middle_name' => $faculty->personal_information->middle_name ?? "N/A",
                'last_name' => $faculty->personal_information->last_name ?? "N/A",
                'name_extension' => $faculty->personal_information->name_extension->title ?? "N/A",
                'place_of_birth' => $faculty->personal_information->place_of_birth ?? "N/A",
                'date_of_birth' => $faculty->personal_information->date_of_birth ?? "N/A",
                'sex' => $faculty->personal_information->sex ?? "N/A",
                'civil_status' => $faculty->personal_information->civil_status->civil_status ?? "N/A",
                'contact_number' => $faculty->personal_information->contact_no ?? "N/A",
                'telephone_number' => $faculty->personal_information->telephone_no ?? "N/A",
                'contact_person_name' => $faculty->personal_information->contact_person->name ?? "N/A",
                'contact_person_number' => $faculty->personal_information->contact_person->contact_no ?? "N/A",
            ],
            'addresses' =>  [
                'residential_id' => $faculty->personal_information->residential_address->id ?? "N/A",
                'residential_houseNumber' => $faculty->personal_information->residential_address->house_block_no ?? "N/A",
                'residential_street' => $faculty->personal_information->residential_address->street ?? "N/A",
                'residential_subdivision' => $faculty->personal_information->residential_address->subdivision_village ?? "N/A",
                'residential_barangay' => $faculty->personal_information->residential_address->barangay ?? "N/A",
                'residential_city' => $faculty->personal_information->residential_address->city_municipality ?? "N/A",
                'residential_province' => $faculty->personal_information->residential_address->province ?? "N/A",
                'residential_zipCode' => $faculty->personal_information->residential_address->zip_code ?? "N/A",
                'permanent_id' => $faculty->personal_information->permanent_address->id ?? "N/A",
                'permanent_houseNumber' => $faculty->personal_information->permanent_address->house_block_no ?? "N/A",
                'permanent_street' => $faculty->personal_information->permanent_address->street ?? "N/A",
                'permanent_subdivision' => $faculty->personal_information->permanent_address->subdivision_village ?? "N/A",
                'permanent_barangay' => $faculty->personal_information->permanent_address->barangay ?? "N/A",
                'permanent_city' => $faculty->personal_information->permanent_address->city_municipality ?? "N/A",
                'permanent_province' => $faculty->personal_information->permanent_address->province ?? "N/A",
                'permanent_zipCode' => $faculty->personal_information->permanent_address->zip_code ?? "N/A",
            ]
        ]);
    }


    public function autocomplete(Request $request)
    {

        $query = $request->search;

        $faculties = Faculty::with(['personal_information', 'roles'])
            ->WhereHas('personal_information', function ($subQuery) use ($query) {
                $subQuery->where('first_name', 'LIKE', '%' . $query . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $query . '%');
            })->select('id', 'faculty_code')->get();

        $formattedFaculties = $faculties->map(function ($faculty) {
            return [
                'id' => $faculty->id ?? null,
                'faculty_code' => $faculty->faculty_code ?? null,
                'personal_information' => [
                    'first_name' => $faculty->personal_information->first_name ?? null,
                    'last_name' => $faculty->personal_information->last_name ?? null,
                ],
                'roles' => $faculty->roles->map(function ($role) {
                    return [
                        'id' => $role->id ?? null,
                        'name' => $role->role_name ?? null,
                    ];
                }),
            ];
        });

        return response()->json([
            'faculties' => $formattedFaculties,
        ]);
    }


    public function getHead(Request $request, $department){

        // $facultiesQuery = Faculty::select('id', 'faculty_code', 'designation_id')
        // ->with([
        //     'personal_information' => fn($query) => $query->select('faculty_id', 'first_name', 'last_name'),
        //     'designation' => fn($query) => $query->select('id', 'department_id')
        //     ->with(['department' => fn($deptQuery) => $deptQuery->select('id', 'name')]),
        // ])->whereHas('designation.department', fn($query) => $query->where('id', $department))
        // ->where('role', 'hr_manager')
        // ->get();

        $facultiesQuery = Faculty::select('id', 'faculty_code', 'designation_id')
        ->with([
            'personal_information' => fn($query) => $query->select('faculty_id', 'first_name', 'last_name'),
            'roles' => fn($query) => $query->select('roles.id', 'role_name'),
            'designation' => fn($query) => $query->select('id', 'department_id')
            ->with(['department' => fn($deptQuery) => $deptQuery->select('id', 'name')]),
        ])->whereHas('designation.department', fn($query) => $query->where('id', $department))
        ->whereHas('roles', fn($query) => $query->where('role_name', 'hr_manager'))
        ->get();

        if ($facultiesQuery->isEmpty()) {
            return response()->json(['message'=>'No department head found!'], 404);
        }

        $transformedFaculties = $facultiesQuery->map(function ($faculty) {
            return [
                'id' => $faculty->id,
                'first_name' => $faculty->personal_information->first_name ?? null,
                'last_name' => $faculty->personal_information->last_name ?? null,
            ];
        });

        return response()->json($transformedFaculties);

    }

    // PrivateAPI

}
