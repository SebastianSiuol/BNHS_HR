@props(['departments', 'designations', 'shifts', 'roles'])



<div class="validate-comp-txt-inputs grid gap-4 mb-4 sm:grid-cols-2">

    <div>
        <x-forms.label label_name="Employee ID" for="emp_id" />
        <x-forms.input name="emp_id" />
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

        <x-forms.label label_name="Select Shift" for="shift" />

        <x-forms.select name="shift">

            <option {{ empty(old('shift'))  ? 'selected=selected': '' }} disabled value="0">Select Shift</option>
        @foreach($shifts as $shift)
            <option value="{{ $shift->id }}" {{ old('shift') ==  $shift->id ? 'selected=selected' : ''}}>
                {{$shift->name}}
            </option>
        @endforeach

        </x-forms.select>

    </div>

    <div>

        <x-forms.label label_name="Select Role" for="role" />

        <x-forms.select name="role">

            <option {{ empty(old('role'))  ? 'selected=selected': '' }} disabled value="0">Select Role</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ old('role') ==  $role->id ? 'selected=selected' : ''}}>
                    {{ucfirst($role->role_name)}}
                </option>
            @endforeach

        </x-forms.select>

    </div>

</div>
