<x-admin.layout>

<x-slot:heading>Add Leave</x-slot:heading>

    <main class="block h-full p-4 sm:ml-80">
        <x-admin.page_header>
            Leaves
        </x-admin.page_header>

        {{-- LEAVE REQUESTS DIV --}}
        <div>
            <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                    Leave Requests
                </h1>

                {{-- LEAVE REQUESTS TABLE --}}
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table id="default-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-sm text-white bg-blue-900  dark:text-gray-400">
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
                                Service Credits
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Documents
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($leaves as $leave)
                            <x-table.row>

                                <x-table.data>
                                    {{ $leave->faculty->personal_information->generateFullName() }}
                                </x-table.data>

                                <x-table.data>
                                    {{ $leave->leave_types->name }}
                                </x-table.data>

                                <x-table.data>
                                    {{ $leave->start_date }}
                                </x-table.data>

                                <x-table.data>
                                    {{ $leave->leave_date }}
                                </x-table.data>

                                <x-table.data>
                                    {{ $leave->faculty->service_credit }}
                                </x-table.data>

                                <x-table.data>
                                    <button data-modal-target="view-documents" data-modal-toggle="view-documents"
                                            type="button"
                                            class="text-white flex items-center justify-between bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-1 py-1 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        <svg class="w-[27px] h-[27px] text-white-600 dark:text-white" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                             viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2"
                                                  d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                            <path stroke="currentColor" stroke-width="2"
                                                  d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        </svg>
                                        View Documents
                                    </button>
                                </x-table.data>

                                <x-table.data>
                                    {{ ucfirst($leave->status) }}
                                </x-table.data>

                                <x-table.data>
                                    <div id="buttons_{{$leave->id}}" {{ $leave->status == 'pending' ? "class=block" : "class=hidden" }}>
                                        <button id="approve_leave"
                                                type="button"
                                                data-userId="{{$leave->id}}"
                                                class="approve_leave text-white items-center justify-between bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-2 me-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                            Approve
                                        </button>
                                        <button id="reject_leave"
                                                type="button"
                                                data-userId="{{$leave->id}}"
                                                class="reject_leave text-white items-center justify-between bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-2 me-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                            Reject
                                        </button>
                                    </div>
                                    <div id="approved_{{$leave->id}}"
                                         class="{{ $leave->status == 'approved' ? "block" : "hidden" }} text-white text-center bg-green-700 font-medium rounded-lg text-sm px-2 py-2 me-2">
                                        Approved
                                    </div>

                                    <div id="rejected_{{$leave->id}}"
                                         class="{{ $leave->status == 'rejected' ? "block" : "hidden" }} text-white text-center bg-red-700 font-medium rounded-lg text-sm px-2 py-2 me-2">
                                        Rejected
                                    </div>
                                </x-table.data>
                            </x-table.row>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- View Documents Modal --}}
        <div id="view-documents" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-fit max-h-full">
                {{-- Modal content --}}
                <div class="relative bg-gray-100 items-center justify-center rounded-lg shadow dark:bg-gray-700">
                    <div class="flex mb items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Documents
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="view-documents">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <div class="p-5">
                        <h1>SAMPLE DOCUMENTS HERE</h1>
                    </div>

                </div>
            </div>
        </div>

    </main>


    <script src="{{asset('js/admin/leave/create.js')}}"></script>
</x-admin.layout>
