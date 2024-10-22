<x-admin.layout>
    <x-slot:heading>Service Credits</x-slot:heading>

    <x-admin.main_container>
        <x-admin.page_header>
            Service Credits Management
        </x-admin.page_header>

        <div class="grid grid-cols-2 grid-flow-row-dense">

            {{--  Service Credit Calculation Div --}}
            <div class="relative p-4 w-full max-w-lg max-h-full">
                <div class="relative bg-white border border-gray-300 rounded-lg shadow ">

                    {{-- Modal header --}}
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Service Credit Calculation
                        </h3>
                    </div>

                    {{-- Modal body --}}
                    <form class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="">
                                <label for="empID" class="block mb-2 text-sm font-medium text-gray-900">Employee ID</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Employee ID" required="">
                            </div>
                            <div class="">
                                <label for="date-join" class="block mb-2 text-sm font-medium text-gray-900">Date</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-blue-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input id="date-picker" datepicker datepicker-autohide datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5" placeholder="Select date" required="">
                                </div>
                            </div>
                            <div class="">
                                <label for="joining-letter" class="block mr-8 mb-2 text-sm font-medium text-gray-900 ">Activity</label>
                                <select id="extension" class="select-validate bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
                                    <option value="male">Activity 1</option>
                                </select>
                            </div>
                            <div class="">
                                <label for="empID" class="block mb-2 text-sm font-medium text-gray-900">Hours Worked</label>
                                <input type="number" min="0" name="hoursWorked" id="hoursWorked" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="" required oninput="validateHours()">
                            </div>
                        </div>
                        <div class="mt-8 flex items-center justify-center">
                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Calculate
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{--  Service Credit Usage Div --}}
            <div class="relative p-4 w-full max-w-lg max-h-full">
                {{-- Modal content --}}
                <div class="relative bg-white border border-gray-300 rounded-lg shadow ">
                    {{-- Modal header --}}
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Service Credit Usage
                        </h3>
                    </div>
                    {{-- Modal body --}}
                    <form class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4">
                            <div class="">
                                <label for="joining-letter" class="block mr-8 mb-2 text-sm font-medium text-gray-900 ">Leave type</label>
                                <select id="extension" class="select-validate bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
                                    <option selected disabled value="male">Select</option>
                                    <option value="male">Registration and election duties (mandated by law)</option>
                                    <option value="male">Services during calamities/rehabilitation (schools as evacuation centers)</option>
                                    <option value="male">Remedial classes during summer/Christmas or outside regular days</option>
                                    <option value="male">Early school year opening services</option>
                                    <option value="male">School sports competitions (outside regular school days)</option>
                                    <option value="male">Teacher training (beyond regular teaching load)</option>
                                    <option value="male">Uncompensated teaching overload</option>
                                    <option value="male">Non-formal education (beyond regular teaching load)</option>
                                    <option value="male">Extra work during regular school days (beyond teaching load)</option>
                                    <option value="male">Testing activities (outside school days)</option>
                                    <option value="male">Special DepEd projects (e.g., workshops, training during summer/weekends) </option>
                                </select>
                            </div>
                            <div class="grid gap-4 grid-cols-2">
                                <div class="">
                                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Start Date</label>
                                    <div class="relative w-full">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-blue-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <input id="startDate-picker" datepicker datepicker-autohide datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5" placeholder="Select date" required="">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="date-join" class="block mb-2 text-sm font-medium text-gray-900">End Date</label>
                                    <div class="relative w-full">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-blue-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <input id="date-picker" datepicker datepicker-autohide datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5" placeholder="Select date" required="">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="mt-8 flex items-center justify-center">
                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Calculate
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{--  Service Credit Accrual Div --}}
            <div class="relative p-4 w-full max-h-full">
                {{-- Modal content --}}
                <div class="relative bg-white border border-gray-300 rounded-lg shadow ">
                    {{-- Modal header --}}
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Service Credit Accrual
                        </h3>
                    </div>
                    {{-- Modal body --}}
                    <form class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-3">
                            <div class="">
                                <label for="" class="block mb-2 text-sm font-medium text-gray-900">Total Service Credits Earned</label>
                                <input disabled type="text" name="name" id="name" class="bg-blue-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Auto Generated" required="">
                            </div>
                            <div class="">
                                <label for="" class="block mb-2 text-sm font-medium text-gray-900">Total Service Credits Used  </label>
                                <input disabled type="number" name="name" id="name" class="bg-blue-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Auto Generated" required="">
                            </div>
                            <div class="">
                                <label for="" class="block mb-2 text-sm font-medium text-gray-900">Available Service Credits </label>
                                <input disabled type="text" name="name" id="name" class="bg-blue-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Auto Generated " required="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{--  Manual Adjustment Sectiom Div --}}
            <div class="relative p-4 w-full max-w-lg max-h-full">
                {{-- Modal content --}}
                <div class="relative bg-white border border-gray-300 rounded-lg shadow ">
                    {{-- Modal header --}}
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Service Credit Adjustment
                        </h3>
                    </div>
                    {{-- Modal body --}}
                    <form class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4">
                            <div class="">
                                <label for="empID" class="block mb-2 text-sm font-medium text-gray-900">Employee ID</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Employee ID" required="">
                            </div>
                            <div class="">
                                <label for="empID" class="block mb-2 text-sm font-medium text-gray-900">Credits Added / Removed</label>
                                <input type="number" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="" required="">
                            </div>
                            <div class="">
                                <label for="" class="block mb-2 text-sm font-medium text-gray-900">Adjustment Reason</label>
                                <textarea type="text" id="comment" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500     "></textarea>
                            </div>
                        </div>


                        <div class="mt-8 flex items-center justify-center">
                            <button type="submit" class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        {{-- REPORT TABLE --}}
        <div id="dailyAttendance-filter" class="bg-white mb-5 border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
            <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                Service Credit Reports
            </h1>
            <div class="grid gap-4 mb-4 sm:grid-cols-4">
                <div class="">
                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Start Date</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-blue-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="reportDate-picker" datepicker datepicker-autohide datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5" placeholder="Select date" required="">
                    </div>
                </div>
                <div class="">
                    <label for="date-join" class="block mb-2 text-sm font-medium text-gray-900">End Date</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-blue-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="EndReport-picker" datepicker datepicker-autohide datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5" placeholder="Select date" required="">
                    </div>
                </div>

                <div>
                    <label for="department" class="block mb-2 text-sm font-medium text-gray-900">File Format</label>
                    <select id="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                        <option disabled selected>Select</option>
                        <option value="">Excel</option>
                        <option value=""> PDF</option>
                    </select>
                </div>


                <div class="mt-7">
                    <button id="showReport" type="button" class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Generate
                    </button>
                </div>
            </div>
        </div>























    </x-admin.main_container>
</x-admin.layout>
