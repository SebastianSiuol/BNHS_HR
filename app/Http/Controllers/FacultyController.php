<?php

namespace App\Http\Controllers;

use App\Exports\PersonalDetailsSheetExport;
use App\Services\StoreFacultyService;
use App\Http\Requests\StoreFacultyRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;




// Models
use App\Models\Faculty;
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

        $facultiesQuery = Faculty::select('id', 'faculty_code', 'designation_id', 'shift_id',)
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
        return Inertia::render('Admin/Faculty/Create');
    }

    public function store(StoreFacultyRequest $request)
    {

        $validated_inputs = $request->validated();
        $validatedDeptHead = $validated_inputs['department_head'] == 'blank' ? null : $validated_inputs['department_head'];
        $faculty_code = Faculty::generateFacultyCode();
        $random_password = str()->random();

        /* Stores Faculty */
        $faculty = new Faculty;
        $faculty->faculty_code      = $faculty_code;
        $faculty->email             = $validated_inputs['email'];
        $faculty->password          = $random_password;
        $faculty->date_of_joining   = $validated_inputs['date_of_joining'];
        $faculty->date_of_leaving   = null;
        // $faculty->photo             = $photo;
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


    public function edit(int $faculty)
    {
        $retrieved_faculty = Faculty::find($faculty);

        $formatted_faculty = $this->formatFacultyForEdit($retrieved_faculty);
        // dd($formattedFaculty);

        return Inertia::render('Admin/Faculty/Edit', [
            'selected_faculty' => $formatted_faculty,
        ]);
    }

    public function update(Request $request, Faculty $faculty)
    {
        $personalDetails = $request->get('personalDetails');
        $companyDetails = $request->get('companyDetails');
        $addresses = $request->get('addresses');
        $accountLoginDetails = $request->get('accountLoginDetails');
        $new_roles = $request->get('roles');

        $validatedDeptHead = $companyDetails['department_head'] == 'blank' ? null : $companyDetails['department_head'];


        $request->validate([

            // ADDRESSES
            'addresses.residential_houseNumber'           => ['required'],
            'addresses.residential_street'                => ['required'],
            'addresses.residential_subdivision'           => ['required'],
            'addresses.residential_barangayName'          => ['required'],
            'addresses.residential_cityName'              => ['required'],
            'addresses.residential_provinceName'          => ['required'],
            'addresses.residential_zipCode'               => ['required'],

            // CONDITIONAL PERMANENT ADDRESS
            'addresses.permanent_houseNumber'             => ['required_unless:addresses.sameAddress,true'],
            'addresses.permanent_street'                  => ['required_unless:addresses.sameAddress,true'],
            'addresses.permanent_subdivision'             => ['required_unless:addresses.sameAddress,true'],
            'addresses.permanent_barangayName'            => ['required_unless:addresses.sameAddress,true'],
            'addresses.permanent_cityName'                => ['required_unless:addresses.sameAddress,true'],
            'addresses.permanent_provinceName'            => ['required_unless:addresses.sameAddress,true'],
            'addresses.permanent_zipCode'                 => ['required_unless:addresses.sameAddress,true'],

            'addresses.sameAddress'                                  => ['nullable', 'boolean'],
        ]);

        // dd($companyDetails);

        // Start Updating
        $faculty->email = $accountLoginDetails['email'];
        $faculty->designation_id = $companyDetails['designation_id'];
        $faculty->school_position_id = $companyDetails['position_id'];
        $faculty->shift_id = $companyDetails['shift_id'];
        $faculty->department_head_id = $validatedDeptHead;
        $faculty->save();


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
        $res_addr->house_block_no           = $addresses['residential_houseNumber'];
        $res_addr->street                   = $addresses['residential_street'];
        $res_addr->subdivision_village      = $addresses['residential_subdivision'];
        $res_addr->barangay                 = $addresses['residential_barangayName'];
        $res_addr->city_municipality        = $addresses['residential_cityName'];
        $res_addr->province                 = $addresses['residential_provinceName'];
        $res_addr->zip_code                 = $addresses['residential_zipCode'];

        if ($addresses['sameAddress']) {
            $perm_addr = $psn_info->permanent_address;
            $perm_addr->house_block_no          = $addresses['residential_houseNumber'];
            $perm_addr->street                  = $addresses['residential_street'];
            $perm_addr->subdivision_village     = $addresses['residential_subdivision'];
            $perm_addr->barangay                = $addresses['residential_barangayName'];
            $perm_addr->city_municipality       = $addresses['residential_cityName'];
            $perm_addr->province                = $addresses['residential_provinceName'];
            $perm_addr->zip_code                = $addresses['residential_zipCode'];
        } else {
            $perm_addr = $psn_info->permanent_address;
            $perm_addr->house_block_no          = $addresses['permanent_houseNumber'];
            $perm_addr->street                  = $addresses['permanent_street'];
            $perm_addr->subdivision_village     = $addresses['permanent_subdivision'];
            $perm_addr->barangay                = $addresses['permanent_barangayName'];
            $perm_addr->city_municipality       = $addresses['permanent_cityName'];
            $perm_addr->province                = $addresses['permanent_provinceName'];
            $perm_addr->zip_code                = $addresses['permanent_zipCode'];
        }

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

    public function destroy(Request $request, Faculty $faculty)
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

        $query = request('query');

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
            ->paginate(5);

        return Inertia::render('Admin/Faculty/Index', [
            'faculties' => $faculties,
        ]);
    }
    public function formatFacultyForEdit($faculty)
    {
        return ([
            'id'                                        => $faculty->id ?? 'N/A',
            'personalDetails' => [
                'id'                                    => $faculty->personal_information->id ?? 'N/A',
                'first_name'                            => $faculty->personal_information->first_name ?? 'N/A',
                'middle_name'                           => $faculty->personal_information->middle_name ?? 'N/A',
                'last_name'                             => $faculty->personal_information->last_name ?? 'N/A',
                'name_extension_id'                     => $faculty->personal_information->name_extension->id ?? 'N/A',
                'place_of_birth'                        => $faculty->personal_information->place_of_birth ?? 'N/A',
                'date_of_birth'                         => $faculty->personal_information->date_of_birth ?? 'N/A',
                'sex'                                   => $faculty->personal_information->sex ?? 'N/A',
                'civil_status_id'                       => $faculty->personal_information->civil_status->id ?? 'N/A',
                'contact_number'                        => $faculty->personal_information->contact_no ?? 'N/A',
                'telephone_number'                      => $faculty->personal_information->telephone_no ?? 'N/A',
                'contact_person_name'                   => $faculty->personal_information->contact_person->name ?? 'N/A',
                'contact_person_number'                 => $faculty->personal_information->contact_person->contact_no ?? 'N/A',
            ],
            'addresses' => [
                'residential_id'                        => $faculty->personal_information->residential_address->id ?? 'N/A',
                'residential_houseNumber'                 => $faculty->personal_information->residential_address->house_block_no ?? 'N/A',
                'residential_street'                    => $faculty->personal_information->residential_address->street ?? 'N/A',
                'residential_subdivision'               => $faculty->personal_information->residential_address->subdivision_village ?? 'N/A',
                // 'residential_barangay'                  => $faculty->personal_information->residential_address->barangay ?? 'N/A',
                // 'residential_city'                      => $faculty->personal_information->residential_address->city_municipality ?? 'N/A',
                // 'residential_province'                  => $faculty->personal_information->residential_address->province ?? 'N/A',
                'residential_zipCode'                  => $faculty->personal_information->residential_address->zip_code ?? 'N/A',
                'permanent_id'                          => $faculty->personal_information->permanent_address->id ?? 'N/A',
                'permanent_houseNumber'                   => $faculty->personal_information->permanent_address->house_block_no ?? 'N/A',
                'permanent_street'                      => $faculty->personal_information->permanent_address->street ?? 'N/A',
                'permanent_subdivision'                 => $faculty->personal_information->permanent_address->subdivision_village ?? 'N/A',
                // 'permanent_barangay'                    => $faculty->personal_information->permanent_address->barangay ?? 'N/A',
                // 'permanent_city'                        => $faculty->personal_information->permanent_address->city_municipality ?? 'N/A',
                // 'permanent_province'                    => $faculty->personal_information->permanent_address->province ?? 'N/A',
                'permanent_zipCode'                    => $faculty->personal_information->permanent_address->zip_code ?? 'N/A',
            ],
            'companyDetails' => [
                'faculty_code'                          => $faculty->faculty_code ?? 'N/A',
                'date_of_joining'                       => $faculty->date_of_joining ?? 'N/A',
                'designation_id'                        => $faculty->designation_id ?? 'N/A',
                'department_id'                         => $faculty->designation->department->id ?? 'N/A',
                'position_id'                           => $faculty->school_position->id ?? 'N/A',
                'shift_id'                              => $faculty->shift->id ?? 'N/A',
            ],
            'accountLoginDetails' => [
                'email' => $faculty->email,

            ],
            'roles' => [
                'roles_id' => $faculty->roles->pluck('id')
            ]
        ]);
    }


    public function pds()
    {
        return Excel::download(new PersonalDetailsSheetExport, 'faculties.xlsx');
    }
}
