<x-admin.layout>


<x-slot:heading>Attendance Report</x-slot:heading>
    <x-admin.main_container>
        <x-admin.page_header>
            Attendance Report
        </x-admin.page_header>

        <form id="myForm" action="#">
            <div id="dailyAttendance-filter" class="bg-white mb-5 border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
                <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                    Attendance Report
                </h1>
                <div class="grid gap-4 mb-4 sm:grid-cols-5">
                    <div>
                        <label for="department" class="block mb-2 text-sm font-medium text-gray-900 ">Department</label>
                        <select id="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                            <option selected>All Departments</option>
                            <option value="">Department 1</option>
                            <option value="">Department 2</option>
                        </select>
                    </div>
                    <div>
                        <label for="shift" class="block mb-2 text-sm font-medium text-gray-900 ">Shift  </label>
                        <select id="shift" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                            <option selected>All Shifts</option>
                            <option value="">Shift 1</option>
                            <option value="">Shift 2</option>
                        </select>
                    </div>
                    <div>
                        <label for="year" class="block mb-2 text-sm font-medium text-gray-900 ">Year  </label>
                        <select id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                            <option value="">2024</option>
                        </select>
                    </div>
                    <div>
                        <label for="month" class="block mb-2 text-sm font-medium text-gray-900 ">Month  </label>
                        <select id="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                            <option value="">January</option>
                            <option value="">February</option>
                            <option value="">March</option>
                            <option value="">April</option>
                            <option value="">May</option>
                            <option value="">June</option>
                            <option value="">July</option>
                            <option value="">August</option>
                            <option value="">September</option>
                            <option value="">October</option>
                            <option value="">November</option>
                            <option value="">December</option>
                        </select>
                    </div>


                    <div class="mt-7">
                        <button id="showReport" type="button" class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                            Show Report
                        </button>
                    </div>
                </div>
            </div>

            <!-- ATTENDANCE TABLE -->
            <div id="report_attendanceTable" class="bg-white border w-full border-gray-200 rounded-md shadow p-4">
                <!-- HEADER -->
                <div class="pb-4 flex items-center justify-between">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" id="table-search" class="block h-10 sm:w-96 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for items">
                    </div>

                    <div class="flex">
                        <p class="text-sm mt-2 mr-3">Show</p>
                        <select id="shift" class="text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                            <option value="">5</option>
                        </select>
                        <p class="text-sm mt-2 ml-3">entries</p>
                    </div>
                </div>

                <!-- MAIN TABLE -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table id="default-table" class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-sm text-white bg-blue-900">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Employee ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Employee Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                01
                            </th>
                            <th scope="col" class="px-6 py-3">
                                02
                            </th>
                            <th scope="col" class="px-6 py-3">
                                03
                            </th>
                            <th scope="col" class="px-6 py-3">
                                04
                            </th>
                            <th scope="col" class="px-6 py-3">
                                05
                            </th>
                            <th scope="col" class="px-6 py-3">
                                06
                            </th>
                            <th scope="col" class="px-6 py-3">
                                07
                            </th>
                            <th scope="col" class="px-6 py-3">
                                08
                            </th>
                            <th scope="col" class="px-6 py-3">
                                09
                            </th>
                            <th scope="col" class="px-6 py-3">
                                10
                            </th>
                            <th scope="col" class="px-6 py-3">
                                11
                            </th>
                            <th scope="col" class="px-6 py-3">
                                12
                            </th>
                            <th scope="col" class="px-6 py-3">
                                13
                            </th>
                            <th scope="col" class="px-6 py-3">
                                14
                            </th>
                            <th scope="col" class="px-6 py-3">
                                15
                            </th>
                            <th scope="col" class="px-6 py-3">
                                16
                            </th>
                            <th scope="col" class="px-6 py-3">
                                17
                            </th>
                            <th scope="col" class="px-6 py-3">
                                18
                            </th>
                            <th scope="col" class="px-6 py-3">
                                19
                            </th>
                            <th scope="col" class="px-6 py-3">
                                20
                            </th>
                            <th scope="col" class="px-6 py-3">
                                22
                            </th>
                            <th scope="col" class="px-6 py-3">
                                23
                            </th>
                            <th scope="col" class="px-6 py-3">
                                24
                            </th>
                            <th scope="col" class="px-6 py-3">
                                25
                            </th>
                            <th scope="col" class="px-6 py-3">
                                26
                            </th>
                            <th scope="col" class="px-6 py-3">
                                27
                            </th>
                            <th scope="col" class="px-6 py-3">
                                28
                            </th>
                            <th scope="col" class="px-6 py-3">
                                29
                            </th>
                            <th scope="col" class="px-6 py-3">
                                30
                            </th>
                            <th scope="col" class="px-6 py-3">
                                31
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($faculties as $faculty)
                            <tr class="odd:bg-blue-100 odd:">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $faculty->faculty_code }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $faculty->personal_information->first_name . ' ' . $faculty->personal_information->last_name }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- PAGINATION -->

                {{ $faculties->links() }}
{{--                <nav class="flex mb-4 items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">--}}
{{--                    <span class="text-sm font-normal text-gray-500  mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-gray-900 ">1-5</span> of <span class="font-semibold text-gray-900 ">100</span></span>--}}
{{--                    <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">--}}
{{--                        <li>--}}
{{--                            <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 ">Previous</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">1</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">2</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700">3</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">4</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">5</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 ">Next</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </nav>--}}
            </div>
        </form>
    </x-admin.main_container>

    <script src={{asset('js/admin-attd-report.js')}}></script>

</x-admin.layout>
