@props(['faculty'])

<div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6 space-y-6">

        <x-forms.form-heading>Company Details</x-forms.form-heading>

        <div class="grid grid-cols-2">
            <x-admin-show-label for=employee_code>Employee ID</x-admin-show-label>
            <x-admin-show-input name=employee_code id=employee_code value="{{$faculty->faculty_code}}"/>
        </div>
        <div class="grid grid-cols-2">
            <x-admin-show-label for=department>Department</x-admin-show-label>
            <x-admin-show-input name=department id=department value="{{$faculty->department->department_name}}"/>
        </div>
        <div class="grid grid-cols-2">
            <x-admin-show-label for=designation>Designation</x-admin-show-label>
            <x-admin-show-input name=designation id=designation
                                value="{{$faculty->designation->department_designation}}"/>
        </div>
        <div class="grid grid-cols-2">
            <x-admin-show-label for=date_of_joining>Date of Joining</x-admin-show-label>
            <x-admin-show-input name=date_of_joining id=date_of_joining value="{{$faculty->date_of_joining}}"/>
        </div>
        <div class="grid grid-cols-2">
            <x-admin-show-label for=date_of_leaving>Date of Leaving</x-admin-show-label>
            <x-admin-show-input name=date_of_leaving id=date_of_leaving value="{{$faculty->date_of_leaving}}"/>
        </div>
        <div class="grid grid-cols-2">
            <x-admin-show-label for=Manager>Manager/Department Head</x-admin-show-label>
            <x-admin-show-input name=Manager id=Manager placeholder="No Head"/>
        </div>
        <div class="grid grid-cols-2">
            <x-admin-show-label for=shift>Shift</x-admin-show-label>
            <x-admin-show-input name=shift id=shift value="{{$faculty->shift->time}}"/>
        </div>
        <div class="grid grid-cols-2">
            <label for="Status" class="block mr-12 mb-2 text-sm font-medium text-gray-900 ">Status</label>
            <form class="max-w-sm mx-auto">
                <select disabled id="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
                    <option selected>Active</option>
                    <option value="">Option 2</option>
                    <option value="">Option 3</option>
                </select>
            </form>
        </div>

</div>
