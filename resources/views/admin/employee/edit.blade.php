<x-admin.layout>


<x-slot:heading>Employee Edit</x-slot:heading>

    <!-- Main Content -->
    <x-admin.main_container>

        <x-admin.page_header>
            Edit Employee [{{ $faculty->faculty_code }}]
        </x-admin.page_header>

        <form method="POST" action="/admin/employees/{{$faculty->id}}">
            @csrf
            @method("PATCH")

            <!-- Personal Details Form -->
            <div id="personalDetails">

                <x-admin.employee.nav-steppers :active_number="1" />

                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                    <x-forms.form-heading>Personal Details</x-forms.form-heading>


                    @if($errors->any())
                        <ul class="my-5">
                            @foreach($errors->all() as $error) @endforeach
                            <li class="text-red-500 italic font-bold">{{ $error }}</li>
                        </ul>
                    @endif

                    <x-employee-edit-forms.psn-deets
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

                <x-admin.employee.nav-steppers :active_number="2" />

                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                    <x-forms.form-heading>Account Login</x-forms.form-heading>

                    <x-employee-edit-forms.acc-login :faculty="$faculty" />

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

                <x-admin.employee.nav-steppers :active_number="3" />


                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                    <x-forms.form-heading>Company Details</x-forms.form-heading>

                    <x-employee-edit-forms.company-deets
                        :departments="$departments"
                        :designations="$designations"
                        :shifts="$shifts"
                        :faculty="$faculty"/>

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

                <x-admin.employee.nav-steppers :active_number="4" />

                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                    <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                        Documents
                    </h1>

                    <x-employee-edit-forms.doc-deets />

                    <div class="flex items center justify-between">

                        <button id="prevToCompanyDetails" type="button"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Prev Step: Company Details
                        </button>

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
    </x-admin.main_container>

    <script src={{asset('js/admin.js')}}></script>
    <script src={{asset('js/validate-edit-forms.js')}}></script>
    <script src={{asset('js/employee/get-designation.js')}}></script>

</x-admin.layout>
