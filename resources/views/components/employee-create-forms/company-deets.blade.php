@props(['generated_id','departments', 'designations', 'shifts'])

<h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
    Company Details
</h1>

<div class="validate-comp-txt-inputs grid gap-4 mb-4 sm:grid-cols-2">
    <div>
        <x-admin-form-label for="emp_id"> Employee ID </x-admin-form-label>
        <x-admin-form-input type="text" id="emp_id" readonly="readonly" value="{{ $generated_id }}"/>
    </div>
    <div>

        <x-admin-form-label for="department"> Department </x-admin-form-label>

        <select id="department"
                name="department"
                autocomplete="false"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option {{ empty(old('department'))  ? 'selected=selected': '' }} disabled value="0">Select Department
            </option>
            @foreach($departments as $department)
                <option
                    value="{!! __($department->id) !!}" {{ old('department') ==  $department->id ? 'selected=selected' : ''}}>
                    {!! __($department->department_name) !!}
                </option>
            @endforeach
        </select>
    </div>
    <div>

        <x-admin-form-label for="department"> Designation </x-admin-form-label>

        <select id="designation"
                name="designation"
                autocomplete="false"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
            <option {{ empty(old('designation'))  ? 'selected=selected': '' }} disabled value="0">Select Designation</option>

            @foreach($designations as $designation)
                <option
                    value="{!! __($designation->id) !!}" {{ old('designation') ==  $designation->id ? 'selected=selected' : ''}}>
                    {!! __($designation->department_designation) !!}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <x-admin-form-label for="date_of_joining"> Date of Joining </x-admin-form-label>

        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-blue-900 " aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </div>
            <input id="date_of_joining"
                   name="date_of_joining"
                   datepicker
                   datepicker-buttons
                   datepicker-autoselect-today
                   datepicker-format="mm-dd-yyyy"
                   datepicker-min-date="01-01-1900"
                   datepicker-max-date="{{date('m-d-Y', strtotime('14 Days')), }}"
                   type="text"
                   class="date-inputs bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5      "
                   placeholder="Select date">
        </div>

    </div>
    <div>

        <x-admin-form-label for="date_of_leaving"> Date of Leaving </x-admin-form-label>

        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-blue-900 " aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </div>
            <input id="date_of_leaving"
                   name="date_of_leaving"
                   datepicker
                   datepicker-buttons
                   datepicker-autoselect-today
                   datepicker-format="mm-dd-yyyy"
                   datepicker-min-date="{{date('m-d-Y', strtotime('-14 Days')), }}"
                   datepicker-max-date="{{date('m-d-Y', strtotime('30 Days')), }}"
                   type="text"
                   class="date-inputs bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5      "
                   placeholder="Select date">
        </div>

    </div>
    <div>

        <x-admin-form-label for="manager"> Manager/Department Head </x-admin-form-label>

        <select id="manager"
                disabled="disabled"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
            <option selected disabled>Select Manager</option>
            <option value="">Example I</option>
            <option value="">Example II</option>
        </select>
    </div>
    <div>

        <x-admin-form-label for="shift"> Manager/Department Head</x-admin-form-label>

        <select id="shift"
                name="shift"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
            <option {{ empty(old('shift'))  ? 'selected=selected': '' }} disabled value="0">Select Shift</option>
            @foreach($shifts as $shift)
                <option value="{{ $shift->id }}" {{ old('shift') ==  $shift->id ? 'selected=selected' : ''}}>
                    {{$shift->name}}
                </option>
            @endforeach
        </select>
    </div>

    <div>

        <x-admin-form-label for="employment_status"> Employment Status</x-admin-form-label>

        <select id="employment_status"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
            <option selected>Active</option>
            <option value="">On-Leave</option>
            <option value="">Dismissed</option>
        </select>
    </div>
</div>
