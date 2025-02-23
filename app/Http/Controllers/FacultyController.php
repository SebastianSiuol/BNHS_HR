<?php

namespace App\Http\Controllers;

use App\Exports\PersonalDetailsSheetExport;
use App\Services\StoreFacultyService;
use App\Http\Requests\StoreFacultyRequest;
use App\Models\Configuration\SchoolPosition;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;




// Models
use App\Models\Faculty;
use App\Models\FacultyAccountInformation\Department;
use App\Models\Role;
use App\Models\Shift;
use Maatwebsite\Excel\Facades\Excel;


class FacultyController extends Controller
{
    public function __construct(
        protected StoreFacultyService $store_faculty,
    ) {}


    public function index()
    {
        $auth_faculty = Auth::user();
        $auth_department_id = $auth_faculty->designation->department_id;
        $auth_faculty_roles = $auth_faculty->roles->pluck('role_name');

        $facultiesQuery = Faculty::select('id','public_id', 'faculty_code', 'designation_id', 'shift_id',)
        ->with([
            'personal_information' => fn($query) => $query->select('faculty_id', 'first_name', 'last_name'),
            'shift' => fn($query) => $query->select('id', 'name'),
            'designation' => fn($query) => $query->select('id', 'department_id')
            ->with(['department' => fn($deptQuery) => $deptQuery->select('id', 'name')]),
        ]);

        if ($auth_faculty_roles->contains('hr_manager')) {
            $facultiesQuery->whereHas('designation.department', fn($query) => $query->where('id', $auth_department_id));
        }

        $faculties = $facultiesQuery->paginate(5);

        return Inertia::render('Admin/Faculty/Index', [
            'faculties' => $faculties,
        ]);
    }
    public function create()
    {
        $departments = Department::select('id', 'name')
            ->with(['designations' => fn($query) => $query->select('id', 'name', 'department_id')])
            ->get();
        $positions = SchoolPosition::select('id','title')->get();
        $shifts = Shift::select('id','name')->get();
        $data = Role::all(['id', 'type', 'description']);

        return Inertia::render('Admin/Faculty/Create', [
            'departments' => $departments,
            'positions' => $positions,
            'shifts' => $shifts,
            'retrievedRoles' => $data,
        ]);
    }

    public function store(StoreFacultyRequest $request)
    {

        $validated_inputs = $request->validated();
        $validatedDeptHead = $validated_inputs['department_head'] == 'blank' ? null : $validated_inputs['department_head'];
        $faculty_code = Faculty::generateFacultyCode();
        $random_password = str()->random();

        /* Roles Validation */
        $roles = $request->roles_id;
        $roles_list = Role::whereIn('id', $roles)->pluck('role_name')->map(fn($role) => strtolower($role));
        if ($roles_list->contains('hr_admin') && $roles_list->contains('hr_manager')) {
            return redirect()
                ->back()
                ->withErrors(['roles_id' => 'Faculty cannot be an Admin and a Manager at the same time.'])
                ->withInput();
        }

        /* Stores Faculty */
        $faculty = new Faculty;
        $faculty->faculty_code      = $faculty_code;
        $faculty->email             = $validated_inputs['email'];
        $faculty->password          = $random_password;
        $faculty->date_of_joining   = $validated_inputs['date_of_joining'];
        $faculty->date_of_leaving   = null;
        $faculty->designation_id    = $validated_inputs['designation_id'];
        $faculty->shift_id          = $validated_inputs['shift_id'];
        $faculty->employment_status_id = 1;
        $faculty->school_position_id = $validated_inputs['position_id'];
        $faculty->department_head_id = $validatedDeptHead;
        $faculty->save();

        foreach ($validated_inputs['roles_id'] as $role) {
            $faculty->roles()->attach($role);
        }

        /* Stores Faculty Details */
        $personal_information = $this->store_faculty->storePersonalInformation($faculty, $validated_inputs);
        $this->store_faculty->storeAddresses($personal_information, $validated_inputs);
        $this->store_faculty->storeContactPerson($personal_information, $validated_inputs);


        // API request payload
        $payload = [
            "to" => $faculty->email,
            "subject" => "Account creation!",
            "text" => "Hello,\n\nPlease use the following account to log-in to the system! \n\n \"Faculty Code\": $faculty_code\n \"Password\": $random_password",
        ];

        // Send the email using the provided API
        Http::post('https://bhnhs-sis-api-v1.onrender.com/api/v1/sis/send-email', $payload);

        return redirect()->route('admin.faculty.index')->with('success', 'Employee created successfully!');
    }


    /**
     * ===============================================================================
     *
     * Edit Functions
     *
     * ===============================================================================
     *
     */

    public function editPsnDeets(int $faculty)
    {
        $fac = Faculty::find($faculty);

        $formatted_faculty = [
            'public_id'                            => $fac->public_id ?? 'N/A',
            'id'                                    => $fac->personal_information->id ?? 'N/A',
            'first_name'                            => $fac->personal_information->first_name ?? 'N/A',
            'middle_name'                           => $fac->personal_information->middle_name ?? 'N/A',
            'last_name'                             => $fac->personal_information->last_name ?? 'N/A',
            'name_extension_id'                     => $fac->personal_information->name_extension->id ?? 'N/A',
            'place_of_birth'                        => $fac->personal_information->place_of_birth ?? 'N/A',
            'date_of_birth'                         => $fac->personal_information->date_of_birth ?? 'N/A',
            'sex'                                   => $fac->personal_information->sex ?? 'N/A',
            'civil_status_id'                       => $fac->personal_information->civil_status->id ?? 'N/A',
            'contact_number'                        => $fac->personal_information->contact_no ?? 'N/A',
            'telephone_number'                      => $fac->personal_information->telephone_no ?? 'N/A',
            'contact_person_name'                   => $fac->personal_information->contact_person->name ?? 'N/A',
            'contact_person_number'                 => $fac->personal_information->contact_person->contact_no ?? 'N/A',
        ];
        return Inertia::render('Admin/Faculty/Edit/PsnDeets', [
            'selectedFaculty' => $formatted_faculty,
        ]);
    }

    public function editAddress(int $faculty)
    {
        $fac = Faculty::find($faculty);

        $formatted_faculty = [
            'public_id'                                 => $fac->public_id ?? 'N/A',
            'residential_id'                            => $fac->personal_information->residential_address->id ?? 'N/A',
            'residential_houseNumber'                   => $fac->personal_information->residential_address->house_block_no ?? 'N/A',
            'residential_street'                        => $fac->personal_information->residential_address->street ?? 'N/A',
            'residential_subdivision'                   => $fac->personal_information->residential_address->subdivision_village ?? 'N/A',
            'residential_zipCode'                       => $fac->personal_information->residential_address->zip_code ?? 'N/A',
            'permanent_id'                              => $fac->personal_information->permanent_address->id ?? 'N/A',
            'permanent_houseNumber'                     => $fac->personal_information->permanent_address->house_block_no ?? 'N/A',
            'permanent_street'                          => $fac->personal_information->permanent_address->street ?? 'N/A',
            'permanent_subdivision'                     => $fac->personal_information->permanent_address->subdivision_village ?? 'N/A',
            'permanent_zipCode'                         => $fac->personal_information->permanent_address->zip_code ?? 'N/A',
        ];

        return Inertia::render('Admin/Faculty/Edit/Addresses', [
            'selectedFaculty' => $formatted_faculty,

        ]);
    }

    public function editCompDeets(int $faculty)
    {
        $fac = Faculty::find($faculty);

        $formatted_faculty = [
            'public_id'                             => $fac->public_id,
            'faculty_code'                          => $fac->faculty_code ?? 'N/A',
            'date_of_joining'                       => $fac->date_of_joining ?? 'N/A',
            'designation_id'                        => $fac->designation_id ?? 'N/A',
            'department_id'                         => $fac->designation->department->id ?? 'N/A',
            'position_id'                           => $fac->school_position->id ?? 'N/A',
            'shift_id'                              => $fac->shift->id ?? 'N/A',
        ];

        $departments = Department::select('id', 'name')
        ->with(['designations' => fn($query) => $query->select('id', 'name', 'department_id')])
        ->get();
        $positions = SchoolPosition::select('id', 'title')->get();
        $shifts = Shift::select('id', 'name')->get();

        return Inertia::render('Admin/Faculty/Edit/CompDeets', [
            'selectedFaculty' => $formatted_faculty,
            'departments' => $departments,
            'positions' => $positions,
            'shifts' => $shifts,
        ]);
    }

    public function editRoles(int $faculty)
    {
        $fac = Faculty::find($faculty);

        $formatted_faculty = [
            'public_id' => $fac->public_id,
            'roles' => [
                'roles_id' => $fac->roles->pluck('id')
            ]
        ];

        $data = Role::all(['id', 'type', 'description']);

        return Inertia::render('Admin/Faculty/Edit/Roles', [
            'selectedFaculty' => $formatted_faculty,
            'rolesOption' => $data,
        ]);
    }

    /**
     * ===============================================================================
     *
     * Update Functions
     *
     * ===============================================================================
     *
     */

    public function updatePsnDeets(Request $request, string $public_id)
    {
        $faculty = Faculty::where('public_id', $public_id)->first();

        $request->validate([
            'first_name'                    => ['required'],
            'middle_name'                   => ['nullable'],
            'last_name'                     => ['required'],
            'name_extension_id'             => ['nullable'],
            'sex'                           => ['required'],
            'place_of_birth'                => ['required'],
            'date_of_birth'                 => ['required', 'date', 'before: -18 year'],
            'contact_number'                => ['required'],
            'telephone_number'              => ['nullable'],
            'civil_status_id'               => ['required'],
            'department_head'               => ['nullable'],
        ]);

        // PERSONAL INFORMATION
        $psn_info = $faculty->personal_information;
        $psn_info->update([
            'first_name'               => $request->first_name,
            'middle_name'              => $request->middle_name,
            'last_name'                => $request->last_name,
            'name_extension_id'        => $request->name_extension_id,
            'sex'                      => $request->sex,
            'place_of_birth'           => $request->place_of_birth,
            'date_of_birth'            => $request->date_of_birth,
            'contact_no'               => $request->contact_number,
            'telephone_no'             => $request->telephone_number,
            'civil_status_id'          => $request->civil_status_id,
        ]);


        $psn_info->save();

        return redirect()
            ->route('admin.faculty.index')
            ->with('success', 'Employee updated successfully!');
    }

    public function updateAddresses(Request $request, string $public_id)
    {
        $faculty = Faculty::where('public_id', $public_id)->first();
        $psn_info = $faculty->personal_information;

        $request->validate([

            // ADDRESSES
            'residential_houseNumber'           => ['required'],
            'residential_street'                => ['required'],
            'residential_subdivision'           => ['required'],
            'residential_barangayName'          => ['required'],
            'residential_cityName'              => ['required'],
            'residential_provinceName'          => ['required'],
            'residential_zipCode'               => ['required'],

            // CONDITIONAL PERMANENT ADDRESS
            'permanent_houseNumber'             => ['required_unless:sameAddress,true'],
            'permanent_street'                  => ['required_unless:sameAddress,true'],
            'permanent_subdivision'             => ['required_unless:sameAddress,true'],
            'permanent_barangayName'            => ['required_unless:sameAddress,true'],
            'permanent_cityName'                => ['required_unless:sameAddress,true'],
            'permanent_provinceName'            => ['required_unless:sameAddress,true'],
            'permanent_zipCode'                 => ['required_unless:sameAddress,true'],

            'sameAddress'                                  => ['nullable', 'boolean'],
        ]);

        //      RESIDENTIAL ADDRESS
        $res_addr = $psn_info->residential_address;
        $res_addr->house_block_no           = $request->residential_houseNumber;
        $res_addr->street                   = $request->residential_street;
        $res_addr->subdivision_village      = $request->residential_subdivision;
        $res_addr->barangay                 = $request->residential_barangayName;
        $res_addr->city_municipality        = $request->residential_cityName;
        $res_addr->province                 = $request->residential_provinceName;
        $res_addr->zip_code                 = $request->residential_zipCode;

        if ($request->sameAddress) {
            $perm_addr = $psn_info->permanent_address;
            $perm_addr->house_block_no          = $request->residential_houseNumber;
            $perm_addr->street                  = $request->residential_street;
            $perm_addr->subdivision_village     = $request->residential_subdivision;
            $perm_addr->barangay                = $request->residential_barangayName;
            $perm_addr->city_municipality       = $request->residential_cityName;
            $perm_addr->province                = $request->residential_provinceName;
            $perm_addr->zip_code                = $request->residential_zipCode;
        } else {
            $perm_addr = $psn_info->permanent_address;
            $perm_addr->house_block_no          = $request->permanent_houseNumber;
            $perm_addr->street                  = $request->permanent_street;
            $perm_addr->subdivision_village     = $request->permanent_subdivision;
            $perm_addr->barangay                = $request->permanent_barangayName;
            $perm_addr->city_municipality       = $request->permanent_cityName;
            $perm_addr->province                = $request->permanent_provinceName;
            $perm_addr->zip_code                = $request->permanent_zipCode;
        }

        $res_addr->save();
        $perm_addr->save();

        return redirect()
            ->route('admin.faculty.index')
            ->with('success', 'Employee updated successfully!');
    }

    public function updateCompDeets(Request $request, string $public_id)
    {
        $faculty = Faculty::where('public_id', $public_id)->first();

        $request->validate([
            'designation_id'                => ['required'],
            'shift_id'                      => ['required'],
            'position_id'                   => ['required'],
            'department_head'               => ['nullable'],
        ]);

        $validatedDeptHead = $request->department_head == 'blank' ? null : $request->department_head;

        $faculty->designation_id = $request->designation_id;
        $faculty->school_position_id = $request->position_id;
        $faculty->shift_id = $request->shift_id;
        $faculty->department_head_id = $validatedDeptHead;
        $faculty->save();

        return redirect()
            ->route('admin.faculty.index')
            ->with('success', 'Employee updated successfully!');
    }

    public function updateRoles(Request $request, string $public_id)
    {

        $faculty = Faculty::where('public_id', $public_id)->first();

        $request->validate([
            'roles_id' => 'required|array',
        ], [
            'roles_id.required' => 'Atleast one role is required!',
        ]);

        $roles = $request->roles_id;
        $roles_list = Role::whereIn('id', $roles)->pluck('role_name')->map(fn($role) => strtolower($role));

        if ($roles_list->contains('hr_admin') && $roles_list->contains('hr_manager')) {
            return redirect()
                ->back()
                ->withErrors(['roles_id' => 'Faculty cannot be an Admin and a Manager at the same time.'])
                ->withInput();
        }

        $old_roles = $faculty->roles->pluck('id');
        $fac_id = $faculty->id;

        $faculty->roles()->detach($old_roles);
        $faculty->roles()->attach($request->roles_id);
        $faculty->save();

        DB::table('sessions')
            ->whereUserId($fac_id)
            ->delete();

        return redirect()
            ->route('admin.faculty.index')
            ->with('success', 'Employee role updated successfully!');
    }

    public function destroy(Faculty $faculty)
    {

        if (Auth::user()->id == $faculty->id) {
            return redirect()
                ->route('admin.faculty.index')
                ->with('error', 'Cannot delete logged-in employee!');
        }

        $faculty->delete();

        return redirect()
            ->route('admin.faculty.index')
            ->with('success', 'Employee deleted successfully!');
    }


    public function search(Request $request)
    {

        $query = $request->query('query');

        $faculties = Faculty::with(['personal_information', 'designation.department', 'shift'])
            ->where('faculty_code',  'LIKE', '%' . $query . '%')
            ->orWhere('email',  'LIKE', '%' . $query . '%')
            ->orWhereHas('personal_information', function ($subQuery) use ($query) {
                $subQuery->where('first_name', 'LIKE', '%' . $query . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $query . '%');
            })

            ->orWhereHas('designation', function ($subQuery) use ($query) {
                $subQuery->whereHas('department', function ($nestedQuery) use ($query) {
                    $nestedQuery->where('name', 'LIKE', '%' . $query . '%');
                });
            })

            ->orWhereHas('shift', function ($subQuery) use ($query) {
                $subQuery->where('name', 'LIKE', '%' . request('query') . '%');
            })
            ->paginate(5)->withQueryString();

        return Inertia::render('Admin/Faculty/Index', [
            'faculties' => $faculties,
        ]);
    }

    public function pds()
    {
        return Excel::download(new PersonalDetailsSheetExport, 'faculties.xlsx');
    }
}
