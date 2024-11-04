<x-admin.layout>


<x-slot:heading>Leave Manage</x-slot:heading>

    <x-admin.main_container>
        <x-admin.page-header>
            Manage Leaves
        </x-admin.page-header>

        <!-- LEAVE REQUESTS DIV -->
        <div class="mb-5">
            <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                    Leave Requests
                </h1>
                <div class="justify-end flex mb-5">
                    <select id="shift" class="text-left bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-fit p-2.5" required="">
                        <option disabled selected value="">Sort By</option>
                        <option value="">By Date</option>
                        <option value="">By Employee</option>
                        <option value="">Leave Type</option>
                    </select>
                </div>
                <!-- LEAVE REQUESTS TABLE -->
                <div class="relative max-h-64 overflow-y-auto shadow-md sm:rounded-lg">
                    <table id="default-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="sticky top-0 text-sm text-center text-white bg-blue-900  dark:text-gray-400">
                        <tr>
                            <th scope="col" class="text-green-400 px-6 py-3">
                                Approved
                            </th>
                            <th scope="col" class="text-red-400 px-6 py-3">
                                Rejected
                            </th>
                            <th scope="col" class="text-yellow-400 px-6 py-3">
                                Pending
                            </th>
                        </tr>
                        </thead>
                        <tbody class="text-center">

                        {{-- Main Columns --}}
                        @for($i = 0 ; $i < $max_rows; $i++)
                            <x-table.data-row>
                                <x-table.data>
                                    @if(isset($approved_requests[$i]))
                                        {{ $approved_requests[$i]->faculty->personal_information->generateFullName() }}
                                    @endif
                                </x-table.data>
                                <x-table.data>
                                    @if(isset($rejected_requests[$i]))
                                        {{ $rejected_requests[$i]->faculty->personal_information->generateFullName() }}
                                    @endif
                                </x-table.data>
                                <x-table.data>
                                    @if(isset($pending_requests[$i]))
                                        {{ $pending_requests[$i]->faculty->personal_information->generateFullName() }}
                                    @endif
                                </x-table.data>
                            </x-table.data-row>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Leave request TABLE -->
        <div id="attendanceTable" class="bg-white border w-full border-gray-200 rounded-md shadow p-4">
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
            </div>

            <!-- MAIN TABLE -->
            <div class="relative max-h-64 overflow-y-auto overflow-x-auto shadow-md sm:rounded-lg">
                <table id="default-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="sticky top-0 text-sm text-white bg-blue-900  dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Employee Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Leave Type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Start Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            End Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Service Credits Used
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Service Credits Remaining
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Leave Days
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($all_leave_requests as $leave_request)
                    <x-table.data-row>
                        <x-table.data>
                            {{ $leave_request->faculty->personal_information->generateFullName() }}
                        </x-table.data>
                        <x-table.data>
                            {{ $leave_request->leave_types->name }}
                        </x-table.data>
                        <x-table.data>
                            {{ $leave_request->start_date }}
                        </x-table.data>
                        <x-table.data>
                            {{ $leave_request->leave_date }}
                        </x-table.data>
                        <x-table.data>
                            N/A
                        </x-table.data>
                        <x-table.data>
                            {{ $leave_request->faculty->service_credit }}
                        </x-table.data>
                        <x-table.data>
                            {{ ucfirst($leave_request->status) }}
                        </x-table.data>
                        <x-table.data>
                            {{ $leave_request->totalLeaveDays() }}
                        </x-table.data>
                    </x-table.data-row>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>


</x-admin.main_container>
</x-admin.layout>
