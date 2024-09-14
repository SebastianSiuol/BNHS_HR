<x-admin-layout :admin="$admin">


<x-slot:heading>Employee Edit</x-slot:heading>

    <!-- Main Content -->
    <main class="block h-full p-4 sm:ml-80">


        <div class="flex items-center pb-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5"
                 stroke="currentColor" class="w-9 h-9 text-blue-900">
                <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
            </svg>
            <h1 class="text-3xl text-blue-900 font-bold ml-2">Edit Employee [{{ $faculty->faculty_code }}]</h1>
        </div>

        <form method="POST" action="/admin/employees/{{$faculty->id}}">
            @csrf
            @method("PATCH")

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

                    @if($errors->any())
                        <ul class="my-5">
                            @foreach($errors->all() as $error) @endforeach
                            <li class="text-red-500 italic font-bold">{{ $error }}</li>
                        </ul>
                    @endif

                    <x-admin-edit-prsn-deets
                        :max_date="$max_date"
                        :civil_statuses="$civil_statuses"
                        :faculty="$faculty"
                        :name_exts="$name_exts"
                        :psn_info="$personal_information"
                    />

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

                    <x-admin-edit-acc-login :faculty="$faculty" />

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
                                   value="{{$faculty->faculty_code}}" >
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
                                <option disabled>Select Department</option>
                            @foreach($departments as $department)
                                <option value="{!! __($department->id) !!}" {{$faculty->department_id === $department->id ? "selected=selected": ""}}>{!! __($department->department_name) !!}</option>
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
                                    <option disabled>Select Designation</option>
                                @foreach($designations as $designation)
                                    <option value="{!! __($designation->id) !!}" {{$faculty->designation_id === $designation->id ? "selected=selected": ""}}>{!! __($designation->department_designation) !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-admin-form-label for="date_of_joining">
                                Date of Joining
                            </x-admin-form-label>
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
                                       value="{{$faculty->date_of_joining}}"
                                       readonly="readonly"
{{--                                       datepicker--}}
{{--                                       datepicker-buttons--}}
{{--                                       datepicker-autoselect-today--}}
{{--                                       datepicker-format="mm-dd-yyyy"--}}
{{--                                       datepicker-min-date="01-01-1900"--}}
{{--                                       datepicker-max-date="{{date('m-d-Y', strtotime('14 Days')), }}"--}}
                                       type="text"
                                       class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5      "
                                       placeholder="Select date">
                            </div>
                        </div>
                        <div>
                            <x-admin-form-label for="date_of_leaving">
                                Date of Leaving
                            </x-admin-form-label>
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
                                       value="{{$faculty->date_of_leaving}}"
                                       datepicker
                                       datepicker-buttons
                                       datepicker-autoselect-today
                                       datepicker-format="mm-dd-yyyy"
                                       datepicker-min-date="{{date('m-d-Y', strtotime('now')), }}"
                                       datepicker-max-date="{{date('m-d-Y', strtotime('30 Years')), }}"
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
                                    name="shift"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
                                <option disabled>Select Shift</option>
                                @foreach($shifts as $shift)
                                    <option value="{{ $shift->id }}" {{ $faculty->shift_id ==  $shift->id ? 'selected=selected' : ''}}>
                                        {{$shift->name}}
                                    </option>
                                @endforeach
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
            <div id="documentsForm" class="hidden">

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

{{--                        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">--}}
{{--                            Edit--}}
{{--                        </button>--}}

                        <button type="button" data-modal-target="confirm-edit" data-modal-toggle="confirm-edit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Edit
                        </button>

                    </div>
                </div>
            </div>
            <!-- End of Documents Form -->

            <!-- START OF EDIT CONFIRM MODAL -->
            <div id="confirm-edit" tabindex="-1"
                 class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button"
                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="confirm-edit">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                Confirm Edit Employee?
                            </h3>
                            <button data-modal-hide="confirm-edit"
                                    type="submit"
                                    class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Yes, I'm sure
                            </button>
                            <button data-modal-hide="confirm-edit"
                                    type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                No, cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OF EDIT CONFIRM MODAL -->

        </form>
    </main>

    <script src={{asset('js/admin.js')}}></script>
    <script src={{asset('js/validate-edit-forms.js')}}></script>
</x-admin-layout>
