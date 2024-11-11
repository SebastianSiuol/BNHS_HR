@props(['generated_id','departments', 'designations', 'shifts', 'roles', 'positions'])



<div class="validate-comp-txt-inputs grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">

    <div>
        <x-forms.label label_name="Employee ID" for="emp_id" />
        <x-forms.input name="emp_id" disabled placeholder="{{ $generated_id }}"/>
    </div>

    <div>

        <x-forms.label label_name="Department" for="department" />

        <x-forms.select name="department">

            <option {{ empty(old('department'))  ? 'selected=selected': '' }} disabled value="0"> Select Department </option>
        @foreach($departments as $department)
            <option value="{!! __($department->id) !!}" {{ old('department') ==  $department->id ? 'selected=selected' : ''}}>
                {!! __($department->name) !!}
            </option>
        @endforeach

        </x-forms.select>

    </div>
    <div>

        <x-forms.label label_name="Designation" for="department" />

        <x-forms.select name="designation">

            <option selected="selected" disabled value="0">Select a Department First</option>

        </x-forms.select>

    </div>
    <div>
        <x-forms.label label_name="Date of Joining" for="date_of_joining" />

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
                   value="{{ old('date_of_joining') }}"
                   datepicker
                   datepicker-autoselect-today
                   datepicker-buttons
                   datepicker-format="mm-dd-yyyy"
                   datepicker-min-date="{{date('m-d-Y', strtotime('now')), }}"
                   datepicker-max-date="{{date('m-d-Y', strtotime('21 Days')), }}"
                   type="text"
                   class="date-inputs bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5      "
                   placeholder="Select date">
        </div>

    </div>

    <div>

        <x-forms.label label_name="Manager/Department Head" for="manager" />


        <x-forms.select name="manager" disabled="disabled">

            <option selected disabled>Select Manager</option>
            <option value="">Example I</option>
            <option value="">Example II</option>

        </x-forms.select>

    </div>
    <div>

        <x-forms.label label_name="Position" for="position" />


        <x-forms.select name="position">

            <option {{ empty(old('shift'))  ? 'selected=selected': '' }} disabled value="0">Select Position</option>
            @foreach($positions as $position)
                <option value="{{ $position->id }}" {{ old('shift') ==  $position->id ? 'selected=selected' : ''}}>
                    {{ $position->title }}
                </option>
            @endforeach

        </x-forms.select>

    </div>
    <div>

        <x-forms.label label_name="Select Shift" for="shift" />

        <x-forms.select name="shift">

            <option {{ empty(old('shift'))  ? 'selected=selected': '' }} disabled value="0">Select Shift</option>
        @foreach($shifts as $shift)
            <option value="{{ $shift->id }}" {{ old('shift') ==  $shift->id ? 'selected=selected' : ''}}>
                {{ ucfirst($shift->name) }}
            </option>
        @endforeach

        </x-forms.select>

    </div>

{{--    <div>--}}

{{--        <x-forms.label label_name="Select Role" for="role" />--}}

{{--        <x-forms.select name="role">--}}

{{--            <option {{ empty(old('role'))  ? 'selected=selected': '' }} disabled value="0">Select Role</option>--}}
{{--            @foreach($roles as $role)--}}
{{--                <option value="{{ $role->id }}" {{ old('role') ==  $role->id ? 'selected=selected' : ''}}>--}}
{{--                    {{ucfirst($role->getName())}}--}}
{{--                </option>--}}
{{--            @endforeach--}}

{{--        </x-forms.select>--}}

{{--    </div>--}}

    <div class="w-full">

        <x-forms.label label_name="Select Roles" for="role" />


        <button id="dropdown_roles_button" data-dropdown-toggle="dropdown_roles"
                class="inline-flex w-full items-center px-4 py-2 text-sm font-medium text-center text-black border border-gray-300 bg-[#f9fafb] rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300"
                type="button">
            Roles
        </button>

        {{-- Dropdown menu --}}
        <div id="dropdown_roles" class="bg-[#f9fafb] hidden rounded-lg shadow w-[50%] sm:w-[35%]">
            <ul class="h-48 w-full pb-3 overflow-y-auto text-sm text-gray-700">

                @foreach($roles as $role)
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100">
                        <input id="checkbox-roles[]"
                               name="checkbox_roles[]"
                               type="checkbox"
                               value="{{ $role->id }}"
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                        <label for="checkbox_roles[]"
                               class="w-full ms-2 text-sm font-medium text-gray-900 rounded">
                            {{ $role->getName() }}
                        </label>
                    </div>
                </li>
                @endforeach

            </ul>
        </div>
    </div>



</div>
