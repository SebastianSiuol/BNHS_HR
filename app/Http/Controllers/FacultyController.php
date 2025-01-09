<?php

namespace App\Http\Controllers;

use App\Exports\FacultiesExport;
use App\Services\StoreFacultyService;
use App\Http\Requests\StoreFacultyRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



// Models
use App\Models\Faculty;
use Maatwebsite\Excel\Facades\Excel;
use PHPUnit\Framework\Constraint\IsEmpty;


class FacultyController extends Controller
{
    public function __construct(
        protected StoreFacultyService $store_faculty,
    ) {}


    public function index(){

        $faculties = Faculty::with('personal_information:faculty_id,first_name,last_name', 'designation.department:id,name', 'shift:id,name')
        ->paginate(5);


        return Inertia::render('Admin/Faculty/Index', [
            'faculties' => $faculties,
        ]);
    }
    public function create(){
        return Inertia::render('Admin/Faculty/Create');
    }

    public function store(StoreFacultyRequest $request){

        $validated_inputs = $request->validated();
        // dd($validated_inputs);

        /* Stores Faculty */
        $faculty = new Faculty;
        $faculty->email             = $validated_inputs['email'];
        // $faculty->password          = $validated_inputs['password'];
        $faculty->date_of_joining   = $validated_inputs['date_of_joining'];
        $faculty->date_of_leaving   = null;
        // $faculty->photo             = $photo;
        $faculty->designation_id    = $validated_inputs['designation_id'];
        $faculty->shift_id          = $validated_inputs['shift_id'];
        $faculty->employment_status_id = 1;
        $faculty->school_position_id = $validated_inputs['position_id'];
        $faculty->save();

        foreach ($validated_inputs['roles_id'] as $role) {
            $faculty->roles()->attach($role);

        }

        /* Stores Faculty Details */
        $personal_information = $this->store_faculty->storePersonalInformation($faculty, $validated_inputs);
        $this->store_faculty->storeAddresses($personal_information, $validated_inputs);
        $this->store_faculty->storeContactPerson($personal_information, $validated_inputs);
        return redirect()->route('admin.faculty.index')->with('success', 'Employee created successfully!');
    }


    public function edit(int $faculty){
        $retrieved_faculty = Faculty::find($faculty);

        $formatted_faculty = $this->formatFacultyForEdit($retrieved_faculty);
        // dd($formattedFaculty);

        return Inertia::render('Admin/Faculty/Edit', [
            'selected_faculty' => $formatted_faculty,
        ]);
    }

    public function update(Request $request, Faculty $faculty){
        $personalDetails = $request->get('personalDetails');
        $companyDetails = $request->get('companyDetails');
        $addresses = $request->get('addresses');
        $accountLoginDetails = $request->get('accountLoginDetails');
        $new_roles = $request->get('roles');

        // Start Updating
        $faculty->update([
            'email' => $accountLoginDetails['email'],
            'designation_id' => $companyDetails['designation_id'],
        ]);

        // PERSONAL INFORMATION
        $psn_info = $faculty->personal_information;
        $psn_info->update([
            'first_name'               => $personalDetails['first_name'],
            'middle_name'              => $personalDetails['middle_name'],
            'last_name'                => $personalDetails['last_name'],
            'name_extension_id'        => $personalDetails['name_extension_id'],
            'sex'                      => $personalDetails['sex'],
            'place_of_birth'           => $personalDetails['place_of_birth'],
            'date_of_birth'            => $personalDetails['date_of_birth'],
            'contact_no'               => $personalDetails['contact_number'],
            'telephone_no'             => $personalDetails['telephone_number'],
            'civil_status_id'          => $personalDetails['civil_status_id'],
        ]);


        //  CONTACT PERSON NUMBER
        $cont_psn = $psn_info->contact_person;
        $cont_psn->name                     = $personalDetails['contact_person_name'];
        $cont_psn->contact_no               = $personalDetails['contact_person_number'];

        //      RESIDENTIAL ADDRESS
        $res_addr = $psn_info->residential_address;
        $res_addr->house_block_no           = $addresses['residential_house_num'];
        $res_addr->street                   = $addresses['residential_street'];
        $res_addr->subdivision_village      = $addresses['residential_subdivision'];
        $res_addr->barangay                 = $addresses['residential_barangay'];
        $res_addr->city_municipality        = $addresses['residential_city'];
        $res_addr->province                 = $addresses['residential_province'];
        $res_addr->zip_code                 = $addresses['residential_zip_code'];

        //      PERMANENT ADDRESS
        $perm_addr = $psn_info->permanent_address;
        $perm_addr->house_block_no          = $addresses['permanent_house_num'];
        $perm_addr->street                  = $addresses['permanent_street'];
        $perm_addr->subdivision_village     = $addresses['permanent_subdivision'];
        $perm_addr->barangay                = $addresses['permanent_barangay'];
        $perm_addr->city_municipality       = $addresses['permanent_city'];
        $perm_addr->province                = $addresses['permanent_province'];
        $perm_addr->zip_code                = $addresses['permanent_zip_code'];

        $old_roles = $faculty->roles->pluck('id');
        $user_id = $faculty->id;


        $faculty->roles()->detach($old_roles);
        $faculty->roles()->attach($new_roles['roles_id']);
        $faculty->save();
        $psn_info->save();
        $cont_psn->save();
        $res_addr->save();
        $perm_addr->save();

        DB::table('sessions')
        ->whereUserId($user_id)
        ->delete();

        return redirect()
        ->route('admin.faculty.index')
        ->with('success', 'Employee updated successfully!');
    }

    public function destroy(Request $request, Faculty $faculty){

        if (Auth::user()->id == $faculty->id){
            return redirect()
                ->route('admin.faculty.index')
                ->with('error', 'Cannot delete logged-in employee!');
        }

        $faculty->delete();

        return redirect()
            ->route('admin.faculty.index')
            ->with('success', 'Employee deleted successfully!');
    }


    public function search(Request $request){

        $query = request('query');

        $faculties = Faculty::with(['personal_information', 'designation.department', 'shift'])
            ->where('faculty_code',  'LIKE' , '%' . $query . '%')
            ->orWhere('email',  'LIKE' , '%' . $query . '%')
            ->orWhereHas('personal_information', function($subQuery) use($query){
                $subQuery->where('first_name', 'LIKE' , '%' . $query . '%')
                ->orWhere('last_name', 'LIKE' , '%' . $query . '%');
            })

            ->orWhereHas('designation', function($subQuery) use($query){
                $subQuery->whereHas('department', function($nestedQuery) use($query){
                  $nestedQuery->where('name', 'LIKE' , '%' . $query . '%');
                });
            })

            ->orWhereHas('shift', function($subQuery) use($query){
                $subQuery->where('name', 'LIKE' , '%' . request('query') . '%');
            })
            ->paginate(5);

        return Inertia::render('Admin/Faculty/Index', [
            'faculties' => $faculties,
        ]);




    }
    public function formatFacultyForEdit($faculty)
    {
        return ([
            'id'                                        => $faculty->id,
            'personalDetails' => [
                'id'                                    => $faculty->personal_information->id,
                'first_name'                            => $faculty->personal_information->first_name,
                'middle_name'                           => $faculty->personal_information->middle_name,
                'last_name'                             => $faculty->personal_information->last_name,
                'name_extension_id'                     => $faculty->personal_information->name_extension->id,
                'place_of_birth'                        => $faculty->personal_information->place_of_birth,
                'date_of_birth'                         => $faculty->personal_information->date_of_birth,
                'sex'                                   => $faculty->personal_information->sex,
                'civil_status_id'                       => $faculty->personal_information->civil_status->id,
                'contact_number'                        => $faculty->personal_information->contact_no,
                'telephone_number'                      => $faculty->personal_information->telephone_no,
                'contact_person_name'                   => $faculty->personal_information->contact_person->name,
                'contact_person_number'                 => $faculty->personal_information->contact_person->contact_no,
            ],
            'addresses' => [
                'residential_id'                        => $faculty->personal_information->residential_address->id,
                'residential_house_num'                 => $faculty->personal_information->residential_address->house_block_no,
                'residential_street'                    => $faculty->personal_information->residential_address->street,
                'residential_subdivision'               => $faculty->personal_information->residential_address->subdivision_village,
                'residential_barangay'                  => $faculty->personal_information->residential_address->barangay,
                'residential_city'                      => $faculty->personal_information->residential_address->city_municipality,
                'residential_province'                  => $faculty->personal_information->residential_address->province,
                'residential_zip_code'                  => $faculty->personal_information->residential_address->zip_code,
                'permanent_id'                          => $faculty->personal_information->permanent_address->id,
                'permanent_house_num'                   => $faculty->personal_information->permanent_address->house_block_no,
                'permanent_street'                      => $faculty->personal_information->permanent_address->street,
                'permanent_subdivision'                 => $faculty->personal_information->permanent_address->subdivision_village,
                'permanent_barangay'                    => $faculty->personal_information->permanent_address->barangay,
                'permanent_city'                        => $faculty->personal_information->permanent_address->city_municipality,
                'permanent_province'                    => $faculty->personal_information->permanent_address->province,
                'permanent_zip_code'                    => $faculty->personal_information->permanent_address->zip_code,
            ],
            'companyDetails' => [
                'faculty_code'                          => $faculty->faculty_code,
                'date_of_joining'                       => $faculty->date_of_joining,
                'designation_id'                        => $faculty->designation_id,
                'department_id'                         => $faculty->designation->department->id,
                'position_id'                           => $faculty->school_position->id,
                'shift_id'                              => $faculty->shift->id,
            ],
            'accountLoginDetails' => [
                'email' => $faculty->email,

            ], 'roles' => [
                'roles_id' => $faculty->roles->pluck('id')
            ]
        ]);
    }

    public function export(){
        return Excel::download(new FacultiesExport, 'faculties.xlsx');
    }

    public function pds(){
        return Excel::download(new FacultiesExport, 'faculties.xlsx');
    }
}
