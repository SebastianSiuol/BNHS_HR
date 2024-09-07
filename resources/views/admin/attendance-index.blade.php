<x-admin-layout :admin="$admin">


<x-slot:heading>Daily Attendance</x-slot:heading>

    <main>
        <main class="block h-full p-4 sm:ml-80">
            <div class="flex items-center pb-8">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-9 h-9 text-blue-900">
                    <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
                <h1 class="text-3xl text-blue-900 font-bold ml-2">Attendance</h1>
            </div>

            <form id="myForm" action="#">
                <div id="dailyAttendance-filter" class="bg-white mb-5 border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
                    <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                        Daily Attendance
                    </h1>
                    <div class="grid gap-4 mb-4 sm:grid-cols-4">
                        <div>
                            <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                            <select id="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                                <option selected>All Departments</option>
                                <option value="">Department 1</option>
                                <option value="">Department 2</option>
                            </select>                    </div>
                        <div>
                            <label for="shift" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shift  </label>
                            <select id="shift" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                                <option selected>All Shifts</option>
                                <option value="">Shift 1</option>
                                <option value="">Shift 2</option>
                            </select>
                        </div>
                        <div>
                            <label for="attendance-date-picker" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-blue-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input id="date-picker" datepicker datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5      " required="" placeholder="Select date">
                            </div>
                        </div>

                        <div class="mt-7">
                            <button id="getEmployee" type="button" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Get Employee
                            </button>
                        </div>
                    </div>
                </div>

                <!-- ATTENDANCE TABLE -->
                <div id="attendanceTable" class="hidden bg-white border w-full border-gray-200 rounded-md shadow p-4">
                    <!-- HEADER -->
                    <div class="pb-4 flex items-center justify-between dark:bg-gray-900">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="text" id="table-search" class="block h-10 sm:w-96 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                        </div>

{{--                        <!-- TODO -->--}}
{{--                        <div class="flex">--}}
{{--                            <p class="text-sm mt-2 mr-3">Show</p>--}}
{{--                            <select id="shift" class="text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">--}}
{{--                                <option value="">1</option>--}}
{{--                                <option value="">2</option>--}}
{{--                                <option value="">3</option>--}}
{{--                                <option value="">4</option>--}}
{{--                                <option value="">5</option>--}}
{{--                            </select>--}}
{{--                            <p class="text-sm mt-2 ml-3">entries</p>--}}
{{--                        </div>--}}
                    </div>

                    <!-- MAIN TABLE -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table id="default-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-white bg-blue-900  dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Employee ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Employee Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Attendance By
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Shift
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    In Time
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Out Time
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    1
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Ryan Basilides
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Admin
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Evening Shift
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    9:00
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    18:00
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <select id="attendance-status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-28 p-2 " required="">
                                        <option value="">Present</option>
                                        <option value="">Absent</option>
                                        <option value="">Late</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    1
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Ryan Basilides
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Admin
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Day Shift
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    11:00
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    20:00
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <select id="attendance-status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-28 p-2 " required="">
                                        <option value="">Present</option>
                                        <option value="">Absent</option>
                                        <option value="">Late</option>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
{{--                    <nav class="flex mb-4 items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">--}}
{{--                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-gray-900 dark:text-white">1-5</span> of <span class="font-semibold text-gray-900 dark:text-white">100</span></span>--}}
{{--                        <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">--}}
{{--                            <li>--}}
{{--                                <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </nav>--}}

                    <div class="flex items center justify-center mt-12">
                        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </main>


    </main>

    <script src={{asset('js/admin-attd-index.js')}}></script>
</x-admin-layout>
