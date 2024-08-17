<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href={{ asset('css/admin.css') }}>
</head>

<body class="h-screen">

    <!-- Header -->
    <div class="px-3 py-2 lg:px-5 lg:pl-3">
        <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
        </button>
        <form method="POST" action="/staff/logout" id="logout-form" class="hidden">
            @csrf
        </form>

        <div class="flex items-center justify-end">
            <div class="flex items-center ms-3">
                <div>
                    <button type="button" class="text-sm bg-gray-200 rounded-full pr-2 pl-1 py-1 inline-flex items-center space-x-4" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                        <span class="sr-only">Open user menu</span>
                        <div>
                            <span class="font-semibold text-black">Andres Santiago</span>
                            <p class="text-gray-600 text-xs pl-11">administrator</p>
                        </div>
                        <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                    </button>
                </div>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                    <div class="px-4 py-3" role="none">
                        <p class="text-sm text-gray-900 dark:text-white" role="none">
                            Andres Santiago
                        </p>
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                            andresantiago@admin.com
                        </p>
                    </div>
                    <ul class="py-1" role="none">
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profile</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Change Password</a>
                        </li>
                        <form method="POST" action="/staff/logout">
                            @csrf
                            <li>
                                <button type='submit' form="logout-form" class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Log Out</button>
                            </li>
                        </form>

                    </ul>
                </div>
            </div>
        </div>
    </div>
       <!-- Sidebar -->

    <aside id="sidebar-multi-level-sidebar" class=" bg fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="flex items-center justify-center mb-9">
            <div class="bg-blue-500 text-white rounded-full w-12 h-12 flex items-center justify-center mt-10">
                LOGO
            </div>
            <span class="font-bold text-2xl md:block mt-10 pl-5">XYZ SCHOOL</span>
        </div>
        <div class="h-full px-3 py-4 overflow-y-auto">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="/admin/home" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 dark:text-gray-400  group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                        </svg>
                        <span class="flex-1 ms-3 text-white text-left rtl:text-right whitespace-nowrap dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">Dashboard</span>
                    </a>
                </li>
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="flex-1 ms-3 text-white text-left rtl:text-right whitespace-nowrap dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">Employees</span>
                        <svg class="w-3 h-3 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="py-2 space-y-2">
                        <li>
                            <a href="/admin/employee" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group bg-gray-100 dark:text-gray-400 hover:text-gray-900 dark:hover:bg-gray-700">Add Employee</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-400 hover:text-gray-900 dark:hover:bg-gray-700">Manage Employees</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="sub-attendance" data-collapse-toggle="sub-attendance">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
                        </svg>

                        <span class="flex-1 ms-3 text-white text-left rtl:text-right whitespace-nowrap dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">Attendance</span>
                        <svg class="w-3 h-3 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <ul id="sub-attendance" class="hidden py-2 space-y-2">
                        <li>
                            <a href="#" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-400 hover:text-gray-900 dark:hover:bg-gray-700">Daily Attendance</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-400 hover:text-gray-900 dark:hover:bg-gray-700">Attendance Report</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>






        <!-- Main Content Add Employee-->
    <main class="block h-full p-4 sm:ml-64">
        <div class="mb-3">
            <h1 class="text-3xl text-blue-900 font-medium">Add Employee</h1>
        </div>

        <div class="flex">
            <!-- Personal details form -->
            <div class="block ml-5">
                <div id="formss" class="mb-5 rounded-lg shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Personal Details
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="#">
                            <div class="flex">
                                <label for="name" class="block mr-8 mb-2 text-sm font-medium text-gray-900 dark:text-white">Name*</label>
                                <input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Full Name" required="">
                            </div>
                            <div class="flex">
                                <label for="Contact_Person" class="block mr-1 mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Person</label>
                                <input type="Contact_Person" name="Contact_Person" id="Contact_Person" placeholder="Contact Person" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            </div>
                            <div class="flex">
                                <label for="birthdate" class="block mr-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth*</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-blue-900 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input id="birthdate-picker" datepicker datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                                </div>
                            </div>
                            <div class="flex">
                                <label for="Gender" class="block mr-8 mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                                    <select id="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block min-w-80 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    </select>
                            </div>
                            <div class="flex">
                                <label for="Contact_Number" class="block  mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                                <input type="contact_number" name="Contact_Number" id="Contact_Number" placeholder="09xxxxxxxxx" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block min-w-80 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            </div>
                            <div class="flex">
                                <label for="local-address" class="block mr-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Local Address</label>
                                <textarea type="text" id="local-address" class="block min-w-80 p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                            </div>
                            <div class="flex">
                                <label for="permanent-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permanent Address</label>
                                <textarea type="text" id="permanent-address" class="block min-w-80 p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                            </div>
                            <div class="flex">
                                <label for="nationality" class="block mr-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Nationality</label>
                                <input type="nationality" name="nationality" id="nationality" placeholder="Nationality" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            </div>
                            <div class="flex">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reference 1 Name*</label>
                                <input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Reference 1 Full Name" required="">
                            </div>
                            <div class="flex">
                                <label for="R1-Phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reference 1 Phone*</label>
                                <input type="R1-Phone" name="R1-Phone" id="R1-Phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="09xxxxxxxxx" required="">
                            </div>
                            <div class="flex">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reference 2 Name*</label>
                                <input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Reference 2 Full Name" required="">
                            </div>
                            <div class="flex">
                                <label for="R2-Phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reference 2 Phone*</label>
                                <input type="R2-Phone" name="R2-Phone" id="R2-Phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="09xxxxxxxxx" required="">
                            </div>
                            <div class="flex">
                                <label for="marital-status" class="block mr-6 mb-2 text-sm font-medium text-gray-900 dark:text-white">Marital Status*</label>
                                    <select id="marital-status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Select</option>
                                    <option value="S">Single</option>
                                    <option value="M">Married</option>
                                    <option value="W">Widowed</option>
                                    <option value="S">Separated</option>
                                    </select>
                            </div>
                            <div class="flex">
                                <label for="photo" class="block mr-12 mb-2 text-sm font-medium text-gray-900 dark:text-white">Photo</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                            </div>
                            <div class="flex">
                                <label for="comment" class="block mr-5 mb-2 text-sm font-medium text-gray-900 dark:text-white">Comment</label>
                                <textarea type="text" id="comment" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        <!-- Other forms -->
            <div class="block ml-5">
            <!-- Account Login -->
                <div id="formss" class="mb-5 rounded-lg shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Account Login
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="#">
                            <div class="flex">
                                <label for="email" class="block mr-12 mb-2 text-sm font-medium text-gray-900 dark:text-white">Email*</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Email" required="">
                            </div>
                            <div class="flex">
                                <label for="password" class="block mr-5 mb-2 text-sm font-medium text-gray-900 dark:text-white">Password*</label>
                                <input type="password" id="password" placeholder="Password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                            </div>
                        </form>
                    </div>
                </div>

            <!-- Company Details -->
                <div id="formss" class="w-screen mb-5 rounded-lg shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Company Details
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="#">
                            <div class="flex">
                                <label for="staff-id" class="block mr-16 mb-2 text-sm font-medium text-gray-900 dark:text-white">Staff ID*</label>
                                <input type="staff-id" disabled name="staff-id" id="staff-id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Auto Generated" required="">
                            </div>
                            <div class="flex">
                                <label for="Department" class="block mr-2 mb-2 text-sm font-medium text-gray-900 dark:text-white">Department*</label>
                                    <select id="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Select Department</option>
                                    <option value="">Department 1</option>
                                    <option value="">Department 2</option>
                                    </select>
                            </div>
                            <div class="flex">
                                <label for="Designation" class="block mr-2 mb-2 text-sm font-medium text-gray-900 dark:text-white">Designation*</label>
                                    <select id="designation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Select Department First</option>
                                    <option value="">Department 1</option>
                                    <option value="">Department 2</option>
                                    </select>
                            </div>
                            <div class="flex">
                                <label for="date-join" class="block mr-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Joining*</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-blue-900 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input id="date-of-joining" datepicker datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                                </div>
                            </div>
                            <div class="flex">
                                <label for="date-leave" class="block mr-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Leaving*</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-blue-900 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input id="date-of-leaving" datepicker datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                                </div>
                            </div>
                            <div class="flex">
                                <label for="manager" class="block mr-6 mb-2 text-sm font-medium text-gray-900 dark:text-white">Manager*</label>
                                    <select id="manager" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Select Manager</option>
                                    <option value="">Manager 1</option>
                                    <option value="">Manager 2</option>
                                    </select>
                            </div>
                            <div class="flex">
                                <label for="shift" class="block mr-14 mb-2 text-sm font-medium text-gray-900 dark:text-white">Shift*</label>
                                    <select id="shift" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Select Shift</option>
                                    <option value="">Shift 1</option>
                                    <option value="">Shift 2</option>
                                    </select>
                            </div>
                            <div class="flex">
                                <label for="Status" class="block mr-12 mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                <form class="max-w-sm mx-auto">
                                    <select id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Active</option>
                                    <option value="">Option 2</option>
                                    <option value="">Option 3</option>
                                    </select>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Documents -->
                <div id="formss" class="rounded-lg shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Documents
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="#">
                            <div class="flex">
                                <label for="resume" class="block mr-10 mb-2 text-sm font-medium text-gray-900 dark:text-white">Resume File</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                            </div>
                            <div class="flex">
                                <label for="offer-letter" class="block mr-11 mb-2 text-sm font-medium text-gray-900 dark:text-white">Offer Letter</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                            </div>
                            <div class="flex">
                                <label for="joining-letter" class="block mr-8 mb-2 text-sm font-medium text-gray-900 dark:text-white">Joining Letter</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                            </div>
                            <div class="flex">
                                <label for="contract" class="block -mr-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Contract & Agreement</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                            </div>
                            <div class="flex">
                                <label for="other" class="block mr-14 mb-2 text-sm font-medium text-gray-900 dark:text-white">Other</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                            </div>
                            <div class="flex">
                                <label for="dropbox-url" class="block mr-9 mb-2 text-sm font-medium text-gray-900 dark:text-white">Dropbox URL</label>
                                <input type="dropbox-url" disabled name="dropbox" id="staff-id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Dropbox URL" required="">
                            </div>
                            <div class="flex">
                                <label for="gdrive-url" class="block mr-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">Google Drive URL</label>
                                <input type="gdrive-url" disabled name="gdrive" id="staff-id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Google Drive URL" required="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <button type="submit" class="w-52 mx-96 my-8 text-white bg-green-600 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save</button>
        </div>



    </main>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>
