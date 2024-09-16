@props(['faculty','departments', 'designations', 'shifts'])



<div class="validate-comp-txt-inputs grid gap-4 mb-4 sm:grid-cols-2">

    <div>
        <x-forms.label label_name="Employee ID" for="emp_id" />
        <x-forms.input name="emp_id" value="{{$faculty->faculty_code}}"/>
    </div>

    <div>

        <x-forms.label label_name="Department" for="department" />

        <x-forms.select name="department">

            <option disabled>Select Department</option>
        @foreach($departments as $department)
            <option value="{!! __($department->id) !!}" {{$faculty->department_id === $department->id ? "selected=selected": ""}}>{!! __($department->department_name) !!}</option>
        @endforeach

        </x-forms.select>

    </div>
    <div>

        <x-forms.label label_name="Designation" for="designation" />

        <x-forms.select name="designation">

            <option disabled>Select Designation</option>--}}
        @foreach($designations as $designation)
            <option value="{!! __($designation->id) !!}" {{$faculty->designation_id === $designation->id ? "selected=selected": ""}}>{!! __($designation->department_designation) !!}</option>
        @endforeach

        </x-forms.select>

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

            <option disabled>Select Shift</option>--}}
        @foreach($shifts as $shift)
            <option value="{{ $shift->id }}" {{ $faculty->shift_id ==  $shift->id ? 'selected=selected' : ''}}>
                {{$shift->name}}
            </option>
        @endforeach

        </x-forms.select>

    </div>

</div>
