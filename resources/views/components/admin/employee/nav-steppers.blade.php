@props(['active_number' => 0])

<ol class="items-center w-full mb-6 space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse">
    <x-admin.employee.add-nav-stepper :active_number="$active_number" :stepper_number="1">

        Personal Details

    </x-admin.employee.add-nav-stepper>
    <x-admin.employee.add-nav-stepper :active_number="$active_number" :stepper_number="2">

        Account Login

    </x-admin.employee.add-nav-stepper>
    <x-admin.employee.add-nav-stepper :active_number="$active_number" :stepper_number="3">

        Company Details

    </x-admin.employee.add-nav-stepper>
    <x-admin.employee.add-nav-stepper :active_number="$active_number" :stepper_number="4">

        Documents

    </x-admin.employee.add-nav-stepper>
</ol>
