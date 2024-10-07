<aside id="sidebar-multi-level-sidebar" class="fixed bg-[#163172] text-white top-0 left-0 z-40 w-80 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
{{--    <div id="burger" class="cursor-pointer text-white p-4 flex justify-end h-7">--}}
{{--        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white transition-transform duration-300 hover:scale-110 hover:text-gray-300">--}}
{{--            <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />--}}
{{--        </svg>--}}
{{--    </div>--}}

    <div class="flex items-center ml-5 justify-center mb-0">
        <div class=" rounded-full w-20 h-15 flex items-center justify-center mt-10 overflow-hidden">
            <img src="{{ asset('images/bhnhs_logo.png') }}" alt="Logo" class="w-full h-full object-cover" />
        </div>
        <div class="ml-2 school-text">
            <span class="font-bold text-lg hidden md:block mt-10 text-white">Batasan Hills National High School</span>
        </div>
    </div>

    <div class="pt-5 mb-9">
        <hr class="mx-5">
    </div>

    <div class="h-full px-3 py-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">

            <div class="ml-3">
                <p class="text-sm">Main</p>
            </div>

            <li class="mb-6">
                <x-admin-sidebar-button href="{{ route('admin.index') }}" :active="request()->is('admin/home')" type="top">
                    <svg class="flex-shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap group-hover:text-gray-900">Dashboard</span>
                </x-admin-sidebar-button>
            </li>

            <div class="ml-3">
                <p class="text-sm">Management</p>
            </div>

            <li>
                {{-- START OF DROPDOWN TOGGLE --}}
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100" aria-controls="sub-employee-buttons" data-collapse-toggle="sub-employee-buttons">
                    <svg class="flex-shrink-0 ml-5 w-5 h-5 text-white transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="flex-1 ms-3 text-white text-left rtl:text-right whitespace-nowrap group-hover:text-gray-900">Employees</span>
                    <svg class="w-3 h-3 text-white transition duration-75 group-hover:text-gray-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                {{-- END OF DROPDOWN TOGGLE --}}

                <ul id="sub-employee-buttons" class=" {{request()->is('admin/employees*') ? '' : 'hidden' }} ml-10 py-2 space-y-2">
                    <li>
                        <x-admin-sidebar-button href="{{ route('employees.create') }}" :active="request()->is('admin/employees/create')" type="sub">Add Employee</x-admin-sidebar-button>
                    </li>
                    <li>
                        <x-admin-sidebar-button href="{{ route('employees.index') }}" :active="request()->is('admin/employees')" type="sub">Manage Employees</x-admin-sidebar-button>
                    </li>
                </ul>
            </li>
            <li>
                {{-- START OF DROPDOWN TOGGLE --}}
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100" aria-controls="sub-attendance" data-collapse-toggle="sub-attendance">
                    <svg class="flex-shrink-0 ml-5 w-5 h-5 text-white transition duration-75 group-hover:text-gray-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
                    </svg>

                    <span class="flex-1 ms-3 text-white text-left rtl:text-right whitespace-nowrap group-hover:text-gray-900 d">Attendance</span>
                    <svg class="w-3 h-3 text-white transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                {{-- END OF DROPDOWN TOGGLE --}}

                <ul id="sub-attendance" class=" {{request()->is('admin/attendances*') ? '' : 'hidden' }} ml-10 py-2 space-y-2">
                    <li>
                        <x-admin-sidebar-button href="{{ route('admin.attendances.index') }}" :active="request()->is('admin/attendances')" type="sub">Daily Attendance</x-admin-sidebar-button>
                    </li>
                    <li>
                        <x-admin-sidebar-button href="{{ route('admin.attendances.report') }}" :active="request()->is('admin/attendances/report')" type="sub">Attendance Report</x-admin-sidebar-button>
                    </li>
                </ul>
            </li>
            <li>
                {{-- START OF DROPDOWN TOGGLE --}}
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100" aria-controls="sub-attendance" data-collapse-toggle="sub-leave">
                    <svg class="flex-shrink-0 ml-5 w-5 h-5 text-white transition duration-75 group-hover:text-gray-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z"/>
                    </svg>

                    <span class="flex-1 ms-3 text-white text-left rtl:text-right whitespace-nowrap group-hover:text-gray-900 ">Leave</span>
                    <svg class="w-3 h-3 text-white transition duration-75 group-hover:text-gray-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                {{-- END OF DROPDOWN TOGGLE --}}

                <ul id="sub-leave" class=" {{ request()->is('admin/leaves*') || request()->is('admin/service-credits*') ? '' : 'hidden' }} ml-10 py-2 space-y-2">
                    <li>
                        <x-admin-sidebar-button href="{{ route('admin.leaves.create') }}" :active="request()->is('admin/leaves/create')" type="sub">Leaves</x-admin-sidebar-button>
                    </li>
                    <li>
                        <x-admin-sidebar-button href="{{ route('admin.leaves.index') }}" :active="request()->is('admin/leaves')" type="sub">Manage Leave</x-admin-sidebar-button>
                    </li>
                    <li>
                        <x-admin-sidebar-button href="{{ route('admin.service-credits.index') }}" :active="request()->is('admin/service-credits')" type="sub">Manage Service Credits</x-admin-sidebar-button>
                    </li>
                </ul>
            </li>

            <div class="ml-3">
                <p class="text-sm">Settings</p>
            </div>

            <li class="mb-6">

                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100" aria-controls="sub-config" data-collapse-toggle="sub-config">
                    <svg class="flex-shrink-0 ml-5 w-5 h-5 text-white transition duration-75 group-hover:text-gray-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M20 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6h-2m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4"/>
                    </svg>

                    <span class="flex-1 ms-3 text-white text-left rtl:text-right whitespace-nowrap group-hover:text-gray-900 ">Configurations</span>
                    <svg class="w-3 h-3 text-white transition duration-75 group-hover:text-gray-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>

                <ul id="sub-config" class=" {{request()->is('admin/config/*') ? '' : 'hidden' }} ml-10 py-2 space-y-2">
                    <li>
                        <x-admin-sidebar-button href="{{ route('admin.config.company_details.index') }}" :active="request()->is( 'admin/config/company_details' )" type="sub">Company Details</x-admin-sidebar-button>
                    </li>
                    <li>
                        <x-admin-sidebar-button href="{{ route('admin.config.department.index') }}" :active="request()->is('admin/config/department')" type="sub">Departments</x-admin-sidebar-button>
                    </li>
                    <li>
                        <x-admin-sidebar-button href="{{ route('admin.config.position.index') }}" :active="request()->is('admin/config/position')" type="sub">Position</x-admin-sidebar-button>
                    </li>
                    <li>
                        <x-admin-sidebar-button href="{{ route('admin.config.shift.index') }}" :active="request()->is('admin/config/shift')" type="sub">Shift</x-admin-sidebar-button>
                    </li>
                    <li>
                        <x-admin-sidebar-button href="#" :active="request()->is('admin/home')" type="sub">Roles</x-admin-sidebar-button>
                    </li>
                </ul>

            </li>
        </ul>
    </div>
</aside>
