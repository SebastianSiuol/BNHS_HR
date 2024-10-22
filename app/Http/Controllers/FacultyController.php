<?php

namespace App\Http\Controllers;

use App\Exports\FacultyExport;
use App\Http\Controllers\Admin\PersonalInformationController;
use App\Models\Faculty;
use App\Models\FacultyAccountInformation\Department;
use App\Models\FacultyAccountInformation\Designation;
use App\Models\PersonalInformation\CivilStatus;
use App\Models\PersonalInformation\ContactPerson;
use App\Models\PersonalInformation\NameExtension;
use App\Models\PersonalInformation\PermanentAddress;
use App\Models\PersonalInformation\PersonalInformation;
use App\Models\PersonalInformation\ResidentialAddress;
use App\Models\Role;
use App\Models\Shift;
use App\Services\StoreFacultyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class FacultyController extends Controller
{
    public function index(){
        $faculties = Faculty::with('personal_information')->first()->paginate(5);

        return view('admin.employee.index',[
            'faculties'         =>$faculties
        ]);
    }

    public function create(){
        return view('admin.employee.create', [
            'generated_id'      => Faculty::generateFacultyCode(),
            'shifts'            => Shift::all(),
            'departments'       => Department::all(),
            'designations'      => Designation::all(),
            'civil_statuses'    => CivilStatus::all(),
            'name_exts'         => NameExtension::all(),
            'max_date'          => date("m/d/Y", strtotime('-21 year')),
            'roles'             => Role::all(),
        ]);
    }

    public function store(Request $request)
    {
        /* Validate Request */
        $validated_inputs = $this->validateStoreFaculty($request);

        /* Stores Faculty */
        $faculty = new Faculty;
        $faculty->email             = $validated_inputs['email'];
        $faculty->password          = $validated_inputs['password'];
        $faculty->date_of_joining   = $validated_inputs['date_of_joining'];
        $faculty->date_of_leaving   = null;
        $faculty->designation_id    = $validated_inputs['designation'];
        $faculty->shift_id          = $validated_inputs['shift'];
        $faculty->save();
        $faculty->roles()->attach($validated_inputs['role']);

        /* Instantiates Service for Storing Faculty Details */
        $store_faculty_service = new StoreFacultyService();

        /* Stores Faculty Details */
        $personal_information = $store_faculty_service->storePersonalInformation($faculty, $validated_inputs);
        $store_faculty_service->storeAddresses($personal_information, $validated_inputs);
        $store_faculty_service->storeContactPerson($personal_information, $validated_inputs);

        /* Redirects */
        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee created successfully!');
    }

    public function show(){
        return redirect()->route('employees.index');
    }

    public function edit(Faculty $faculty){

        return view('admin.employee.edit', [
            'faculty'               => $faculty,
            'personal_information'  => $faculty->personal_information,

//          Dropdown Choices
            'max_date'              => date("m/d/Y", strtotime('-18 year')),
            'shifts'                => Shift::all(),
            'departments'           => Department::all(),
            'designations'          => Designation::all(),
            'civil_statuses'        => CivilStatus::all(),
            'name_exts'             => NameExtension::all(),
        ]);
    }

    public function update(Request $request, Faculty $faculty){

        $validated_inputs = $request->validate([
            'email'                         => ['required', 'string', 'max:255'],
            'designation'                   => ['required'],
            'shift'                         => ['required'],

//          PERSONAL INFORMATION
            'first_name'                    => ['required'],
            'middle_name'                   => ['nullable'],
            'last_name'                     => ['required'],
            'name_extension'                => ['nullable'],
            'sex'                           => ['required'],
            'place_of_birth'                => ['required'],
            'date_of_birth'                 => ['required', 'date_format:m-d-Y', 'after:-100 years', 'before:-18 years'],
            'contact_number'                => ['required'],
            'telephone_number'              => ['nullable'],
            'civil_status'                  => ['required'],

//          CONTACT PERSON
            'contact_person_name'           => ['required'],
            'contact_person_number'         => ['nullable'],

//          ADDRESSES
            'residential_house_num'         => ['required'],
            'residential_street'            => ['required'],
            'residential_subdivision'       => ['required'],
            'residential_barangay'          => ['required'],
            'residential_city'              => ['required'],
            'residential_province'          => ['required'],
            'residential_zip_code'          => ['required'],
            'permanent_house_num'           => ['required'],
            'permanent_street'              => ['required'],
            'permanent_subdivision'         => ['required'],
            'permanent_barangay'            => ['required'],
            'permanent_city'                => ['required'],
            'permanent_province'            => ['required'],
            'permanent_zip_code'            => ['required'],

        ], [
            'date_of_birth.before' => 'The employee must be at least 18 years old!',
            'date_of_leaving.after' => 'The leaving date cannot be an earlier day than today!',

        ]);
//      END OF VALIDATIONS

//      START OF EDITING
//      ACCOUNT DETAILS
        $faculty->email                     = $validated_inputs['email'];
        $faculty->designation_id            = $validated_inputs['designation'];

//      PERSONAL INFORMATION DETAILS
        $psn_info = $faculty->personal_information;
        $psn_info->first_name               = $validated_inputs['first_name'];
        $psn_info->middle_name              = $validated_inputs['middle_name'];
        $psn_info->last_name                = $validated_inputs['last_name'];
        $psn_info->name_extension_id        = $validated_inputs['name_extension'];
        $psn_info->sex                      = $validated_inputs['sex'];
        $psn_info->place_of_birth           = $validated_inputs['place_of_birth'];
        $psn_info->date_of_birth            = $validated_inputs['date_of_birth'];
        $psn_info->contact_no               = $validated_inputs['contact_number'];
        $psn_info->telephone_no             = $validated_inputs['telephone_number'];
        $psn_info->civil_status_id          = $validated_inputs['civil_status'];

//      CONTACT PERSON DETAILS
        $cont_psn = $psn_info->contact_person;
        $cont_psn->name                     = $validated_inputs['contact_person_name'];
        $cont_psn->contact_no               = $validated_inputs['contact_person_number'];

//      RESIDENTIAL ADDRESS
        $res_addr = $psn_info->residential_address;
        $res_addr->house_block_no           = $validated_inputs['residential_house_num'];
        $res_addr->street                   = $validated_inputs['residential_street'];
        $res_addr->subdivision_village      = $validated_inputs['residential_subdivision'];
        $res_addr->barangay                 = $validated_inputs['residential_barangay'];
        $res_addr->city_municipality        = $validated_inputs['residential_city'];
        $res_addr->province                 = $validated_inputs['residential_province'];
        $res_addr->zip_code                 = $validated_inputs['residential_zip_code'];

//      PERMANENT ADDRESS
        $perm_addr = $psn_info->permanent_address;
        $perm_addr->house_block_no          = $validated_inputs['permanent_house_num'];
        $perm_addr->street                  = $validated_inputs['permanent_street'];
        $perm_addr->subdivision_village     = $validated_inputs['permanent_subdivision'];
        $perm_addr->barangay                = $validated_inputs['permanent_barangay'];
        $perm_addr->city_municipality       = $validated_inputs['permanent_city'];
        $perm_addr->province                = $validated_inputs['permanent_province'];
        $perm_addr->zip_code                = $validated_inputs['permanent_zip_code'];
//      END OF EDITING


//      COMMITTING CHANGED DETAILS
        $faculty->save();
        $psn_info->save();
        $cont_psn->save();
        $res_addr->save();
        $perm_addr->save();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully!');
    }

    public function destroy(Faculty $faculty){

        if (Auth::user()->id == $faculty->id){
            return redirect()
                ->route('employees.index')
                ->with('error', 'Cannot delete logged-in employee!');
        }

        $faculty->delete();
        return redirect()
            ->route('employees.index')
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

        return view('admin.employee.index')
            ->with('faculties', $faculties);
    }

    public function export(){
        return Excel::download(new FacultyExport, 'faculties.xlsx');
    }

    public function validateStoreFaculty(Request $request){
        return $request->validate([
            'email'                         => ['required', 'string', 'email', 'max:255', 'unique:faculties'],
            'password'                      => ['required', 'string', 'min:8'],
            'date_of_joining'               => ['required', 'date_format:m-d-Y', 'after_or_equal:-1 day'],
            'designation'                   => ['required'],
            'shift'                         => ['required'],
            'role'                           => ['required'],

//          PERSONAL INFORMATION
            'first_name'                    => ['required'],
            'middle_name'                   => ['nullable'],
            'last_name'                     => ['required'],
            'name_extension'                => ['nullable'],
            'sex'                           => ['required'],
            'place_of_birth'                => ['required'],
            'date_of_birth'                 => ['required', 'date_format:m-d-Y', 'before: -18 year'],
            'contact_number'                => ['required'],
            'telephone_number'              => ['nullable'],
            'civil_status'                  => ['required'],

//          CONTACT PERSON
            'contact_person_name'           => ['required'],
            'contact_person_number'         => ['nullable'],

//          ADDRESSES
            'residential_house_num'         => ['required'],
            'residential_street'            => ['required'],
            'residential_subdivision'       => ['required'],
            'residential_barangay'          => ['required'],
            'residential_city'              => ['required'],
            'residential_province'          => ['required'],
            'residential_zip_code'          => ['required'],
            'permanent_house_num'           => ['required'],
            'permanent_street'              => ['required'],
            'permanent_subdivision'         => ['required'],
            'permanent_barangay'            => ['required'],
            'permanent_city'                => ['required'],
            'permanent_province'            => ['required'],
            'permanent_zip_code'            => ['required'],
        ],[
            'date_of_birth.before' => 'The employee must be at least 18 years old!',
            'date_of_joining.after_or_equal' => 'The joining date cannot be an earlier day than today!',
        ]);
    }
}
