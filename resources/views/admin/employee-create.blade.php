<x-admin-layout :admin="$admin">


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

                    @if($errors->any())
                        <ul class="my-5">
                            @foreach($errors->all() as $error) @endforeach
                            <li class="text-red-500 italic font-bold">{{ $error }}</li>
                        </ul>
                    @endif

                    <x-admin-personal-details-form :max_date=$max_date :civil_statuses=$civil_statuses :name_exts=$name_exts />

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

                    <x-admin-account-login-form />

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


            <!-- START OF COMPANY DETAILS FORM -->
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


                <!-- Inputs -->
                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                    <x-employee-create-forms.company-deets
                        :generated_id="$generated_id"
                        :departments="$departments"
                        :designations="$designations"
                        :shifts="$shifts"
                    />

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
            <!-- END OF COMPANY DETAILS FORM -->


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

                        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Save
                        </button>

                    </div>
                </div>
            </div>
            <!-- End of Documents Form -->


        </form>
    </main>

    <script src={{asset('js/admin.js')}}></script>
    <script src={{asset('js/validate-create-forms.js')}}></script>
</x-admin-layout>
