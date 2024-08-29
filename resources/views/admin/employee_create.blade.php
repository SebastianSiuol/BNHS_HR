<x-admin-layout>

    <x-slot:heading>Employee Creation</x-slot:heading>

    <!-- Main Content -->
    <main class="block h-full p-4 sm:ml-80">


        <div class="flex items-center pb-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5"
                 stroke="currentColor" class="w-9 h-9 text-blue-900">
                <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
            </svg>
            <h1 class="text-3xl text-blue-900 font-bold ml-2">Add Employee</h1>
        </div>

        <form method="POST" action="/admin/employees">
            @csrf

            <!-- Personal Details Form -->
            <div id="personalDetails">

                <ol class="items-center w-full mb-6 space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse">
                    <x-admin-employee-add-nav-stepper :active='true'>

                        <x-slot:number>1</x-slot:number>

                        Personal Details

                    </x-admin-employee-add-nav-stepper>
                    <x-admin-employee-add-nav-stepper>

                        <x-slot:number>2</x-slot:number>

                        Account Login

                    </x-admin-employee-add-nav-stepper>
                    <x-admin-employee-add-nav-stepper>

                        <x-slot:number>3</x-slot:number>

                        Company Details

                    </x-admin-employee-add-nav-stepper>
                    <x-admin-employee-add-nav-stepper>

                        <x-slot:number>4</x-slot:number>

                        Documents

                    </x-admin-employee-add-nav-stepper>
                </ol>

                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                    <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                        Personal Details
                    </h1>

                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <div class="mt-4">
                                <x-admin-form-label for="first_name">
                                    First Name
                                </x-admin-form-label>
                                <x-admin-form-input type="text" name="first_name" id="first_name">
                                    First Name
                                </x-admin-form-input>
                            </div>

                            <div class="mt-4">
                                <x-admin-form-label for="middle_name">
                                    Middle Name
                                </x-admin-form-label>
                                <x-admin-form-input type="text" name="middle_name" id="middle_name">
                                    Middle Name
                                </x-admin-form-input>
                            </div>

                            <div class="mt-4">
                                <x-admin-form-label for="last_name">
                                    Last Name
                                </x-admin-form-label>
                                <x-admin-form-input type="text" name="last_name" id="last_name">
                                    Last Name
                                </x-admin-form-input>
                            </div>

                            <div class="mt-4">
                                <x-admin-form-label for="name_extension">
                                    Name Extension
                                </x-admin-form-label>
                                <x-admin-form-input type="text" name="name_extension" id="name_extension">
                                    Name Extension
                                </x-admin-form-input>
                            </div>

                            <div class="mt-4">
                                <x-admin-form-label for="birthdate">
                                    Date of Birth
                                </x-admin-form-label>

                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-blue-900 " aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input id="birthdate-picker"
                                           datepicker
                                           datepicker-autoselect-today
                                           datepicker-max-date="{{$max_date}}"
                                           name="birthdate"
                                           type="text"
                                           class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5      "
                                           placeholder="Select date">
                                </div>

                            </div>

                            <div class="mt-4">
                                <x-admin-form-label for="contact_number">
                                    Contact Number
                                </x-admin-form-label>
                                <x-admin-form-input type="text" name="contact_number" id="contact_number">
                                    09xxxxxxxxx
                                </x-admin-form-input>
                            </div>

                            <div class="mt-4">
                                <x-admin-form-label for="nationality">
                                    Nationality
                                </x-admin-form-label>

                                <x-admin-form-input type="text" name="nationality" id="nationality">
                                    Nationality
                                </x-admin-form-input>
                            </div>

                            <div class="mt-4">

                                <x-admin-form-label for="reference_name_01">
                                    Reference Name 01
                                </x-admin-form-label>

                                <x-admin-form-input type="text" name="reference_name_01" id="reference_name_01">
                                    John Doe
                                </x-admin-form-input>

                            </div>

                            <div class="mt-4">

                                <x-admin-form-label for="reference_contact_01">
                                    Reference Contact Number 01
                                </x-admin-form-label>
                                <x-admin-form-input type="text" name="reference_contact_01" id="reference_contact_01">
                                    09xxxxxxxxx
                                </x-admin-form-input>

                            </div>
                            <div class="mt-4">

                                <x-admin-form-label for="reference_name_02">
                                    Reference Name 02
                                </x-admin-form-label>
                                <x-admin-form-input type="text" name="reference_name_02" id="reference_name_02">
                                    Jane Doe
                                </x-admin-form-input>

                            </div>
                            <div class="mt-4">

                                <x-admin-form-label for="reference_contact_02">
                                    Reference Contact Number 01
                                </x-admin-form-label>
                                <x-admin-form-input type="text" name="reference_contact_02" id="reference_contact_02">
                                    09xxxxxxxxx
                                </x-admin-form-input>

                            </div>
                        </div>

                        <div>
                            <div class="mt-4">
                                <x-admin-form-label for="contact_person_name">
                                    Contact Person Name
                                </x-admin-form-label>
                                <x-admin-form-input type="text" name="contact_person_name" id="contact_person_name">
                                    John Doe
                                </x-admin-form-input>
                            </div>

                            <div class="mt-4">
                                <x-admin-form-label for="contact_person_number">
                                    Contact Person Number
                                </x-admin-form-label>
                                <x-admin-form-input type="text" name="contact_person_number" id="contact_person_number">
                                    09xxxxxxxxx
                                </x-admin-form-input>
                            </div>

                            <div class="mt-4">
                                <x-admin-form-label for="sex">
                                    Sex
                                </x-admin-form-label>
                                <select id="sex"
                                        name="sex"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
                                    <option selected disabled>Select Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="mt-4">
                                <x-admin-form-label for="local_address">
                                    Local Address
                                </x-admin-form-label>
                                <textarea disabled
                                          id="local_address"
                                          name="local_address"
                                          class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                            <div class="mt-4">
                                <x-admin-form-label for="marital_status">
                                    Marital Status
                                </x-admin-form-label>
                                <select id="marital_status"
                                        name="marital_status"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected disabled>Select Marital Status</option>
                                    @foreach($civil_statuses as $civil_status)
                                        <option
                                            value="{{ $civil_status->id }}">{{$civil_status->civil_status}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mt-4">
                                <x-admin-form-label for="photo">
                                    Photo
                                </x-admin-form-label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none"
                                    id="file_input" type="file">
                            </div>
                            <div class="mt-4">
                                <x-admin-form-label for="comment">
                                    Comment
                                </x-admin-form-label>
                                <textarea disabled
                                          id="comment"
                                          name="comment"
                                          class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>

                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button id="nextToAccountLogin"
                                type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Next Step: Account Login
                        </button>
                    </div>
                </div>
            </div>
            <!-- End of Personal Details Form -->


            <!-- Account Login Form -->
            <div id="accountLogin" class="hidden">

                <ol class="items-center w-full mb-6 space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse">
                    <x-admin-employee-add-nav-stepper>

                        <x-slot:number>1</x-slot:number>

                        Personal Details

                    </x-admin-employee-add-nav-stepper>
                    <x-admin-employee-add-nav-stepper :active='true'>

                        <x-slot:number>2</x-slot:number>

                        Account Login

                    </x-admin-employee-add-nav-stepper>
                    <x-admin-employee-add-nav-stepper>

                        <x-slot:number>3</x-slot:number>

                        Company Details

                    </x-admin-employee-add-nav-stepper>
                    <x-admin-employee-add-nav-stepper>

                        <x-slot:number>4</x-slot:number>

                        Documents

                    </x-admin-employee-add-nav-stepper>
                </ol>

                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                    <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                        Account Login
                    </h1>
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="name@email.com" >
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="•••••••••" >
                        </div>
                    </div>

                    <div class="flex items center justify-between">
                        <button id="prevToPersonalDetails" type="button"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Prev Step: Personal Details
                        </button>
                        <button id="nextToCompanyDetails"
                                type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Next Step: Company Details
                        </button>
                    </div>
                </div>
            </div>
            <!-- End of Account Login Form -->


            <!-- Company Details Form -->
            <div id="companyDetails" class="hidden">

                <ol class="items-center w-full mb-6 space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse">
                    <x-admin-employee-add-nav-stepper>

                        <x-slot:number>1</x-slot:number>

                        Personal Details

                    </x-admin-employee-add-nav-stepper>
                    <x-admin-employee-add-nav-stepper>

                        <x-slot:number>2</x-slot:number>

                        Account Login

                    </x-admin-employee-add-nav-stepper>
                    <x-admin-employee-add-nav-stepper :active='true'>

                        <x-slot:number>3</x-slot:number>

                        Company Details

                    </x-admin-employee-add-nav-stepper>
                    <x-admin-employee-add-nav-stepper>

                        <x-slot:number>4</x-slot:number>

                        Documents

                    </x-admin-employee-add-nav-stepper>
                </ol>

                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                    <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                        Company Details
                    </h1>
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="emp_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee
                                ID</label>
                            <input type="text"
                                   name="emp_id"
                                   id="emp_id"
                                   disabled
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="{{$generated_id}}" >
                        </div>
                        <div>

                            <label for="department"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Department
                            </label>

                            <select id="department"
                                    name="department"
                                    autocomplete="false"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected="selected" disabled>Select Department</option>
                            @foreach($departments as $department)
                                <option value="{!! __($department->id) !!}">{!! __($department->department_name) !!}</option>
                            @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="designation"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Designation</label>
                            <select id="designation"
                                    name="designation"
                                    autocomplete="false"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
                                    <option selected="selected" disabled>Select Designation</option>
                                @foreach($designations as $designation)
                                    <option value="{!! __($designation->id) !!}">{!! __($designation->department_designation) !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="date-join" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                                of Joining</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-blue-900 " aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input id="date-join-picker" datepicker datepicker-buttons datepicker-autoselect-today
                                       type="text"
                                       class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5      "
                                       placeholder="Select date">
                            </div>
                        </div>
                        <div>
                            <label for="date-leave"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of
                                Leaving</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-blue-900 " aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input id="date-leave-picker" datepicker datepicker-buttons datepicker-autoselect-today
                                       type="text"
                                       class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5      "
                                       placeholder="Select date">
                            </div>
                        </div>
                        <div>
                            <label for="manager" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Manager
                                / Department Head </label>
                            <select id="manager"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
                                <option selected disabled>Select Manager</option>
                                <option value="">Example I</option>
                                <option value="">Example II</option>
                            </select>
                        </div>
                        <div>
                            <label for="shift" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shift </label>
                            <select id="shift"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
                                <option select disabled>Select Shift</option>
                                <option value="">Shift 1</option>
                                <option value="">Shift 2</option>
                            </select>
                        </div>

                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status </label>
                            <select id="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
                                <option selected>Active</option>
                                <option value="">On-Leave</option>
                                <option value="">Dismissed</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items center justify-between">
                        <button id="prevToAccountLogin" type="button"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Prev Step: Account Login
                        </button>
                        <button id="nextToDocuments"
                                type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Next Step: Documents
                        </button>
                    </div>

                </div>
            </div>
            <!--End of Company Details Form-->


            <!-- Documents Form -->
            <div id="Documents" class="hidden">

                <ol class="items-center w-full mb-6 space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse">
                    <x-admin-employee-add-nav-stepper>

                        <x-slot:number>1</x-slot:number>

                        Personal Details

                    </x-admin-employee-add-nav-stepper>
                    <x-admin-employee-add-nav-stepper>

                        <x-slot:number>2</x-slot:number>

                        Account Login

                    </x-admin-employee-add-nav-stepper>
                    <x-admin-employee-add-nav-stepper>

                        <x-slot:number>3</x-slot:number>

                        Company Details

                    </x-admin-employee-add-nav-stepper>
                    <x-admin-employee-add-nav-stepper :active='true'>

                        <x-slot:number>4</x-slot:number>

                        Documents

                    </x-admin-employee-add-nav-stepper>
                </ol>

                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                    <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                        Documents
                    </h1>

                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="resume_file"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Resume File
                            </label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none"
                                name="resume_file"
                                id="file_input"
                                type="file">
                        </div>
                        <div>
                            <label for="offer_letter"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Offer Letter</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none"
                                   name="offer_letter"
                                   id="file_input"
                                   type="file">
                        </div>
                        <div>
                            <label for="joining_letter"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Joining Letter
                            </label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none"
                                   name="joining_letter"
                                   id="file_input"
                                   type="file">
                        </div>
                        <div>
                            <label for="contract_and_agreement_file"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Contract & Agreement
                            </label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none"
                                   name="contract_and_agreement_file"
                                   id="file_input"
                                   type="file">
                        </div>
                        <div>
                            <label for="other_documents" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Other Documents
                            </label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none"
                                   name="other_documents"
                                   id="file_input"
                                   type="file">
                        </div>
                        <div>
                            <label for="dropbox-url"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Dropbox URL
                            </label>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   name="dropbox_url"
                                   id="emp_id"
                                   type="text"
                                   placeholder="Dropbox URL"
                                    disabled>
                        </div>
                        <div>
                            <label for="gdrive-url"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Google Drive URL
                            </label>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   id="emp_id"
                                   name="gdrive-url"
                                   type="text"
                                   placeholder="Google Drive URL"
                                   disabled>
                        </div>
                    </div>

                    <div class="flex items center justify-between">

                        <button id="prevToCompanyDetails" type="button"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Prev Step: Company Details
                        </button>

                        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Save
                        </button>

                    </div>
                </div>
            </div>
            <!-- End of Documents Form -->

            <button class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                    type="submit">
                Save
            </button>

        </form>

    </main>

    <script src={{asset('js/admin.js')}}></script>
</x-admin-layout>
