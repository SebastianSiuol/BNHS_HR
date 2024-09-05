<x-admin-layout>

    <x-slot:heading>Add Leave</x-slot:heading>

    <main class="block h-full p-4 sm:ml-80">
        <div class="flex items-center pb-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-9 h-9 text-blue-900">
                <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
            <h1 class="text-3xl text-blue-900 font-bold ml-2">Add Leave</h1>
        </div>

        <!-- LEAVE REQUESTS DIV -->
        <div>
            <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                    Leave Requests
                </h1>

                <!-- LEAVE REQUESTS TABLE -->
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
                        <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Ryan Basilides
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Sick Leave
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Jan 18 2024
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Jan 22 2024
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            </td>
                            <td class="px-6 py-4 font-medium text-green-500 whitespace-nowrap dark:text-white">
                                <button data-modal-target="view-documents" data-modal-toggle="view-documents" type="button" class="text-white flex items-center justify-between bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-1 py-1 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    <svg class="w-[27px] h-[27px] text-white-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                        <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    </svg>
                                    View Documents
                                </button>
                            </td>
                            <td class="px-6 py-4 font-medium text-green-500 whitespace-nowrap dark:text-white">
                                Active
                            </td>
                            <td class="sm:flex px-6 py-4 font-medium text-green-500 whitespace-nowrap dark:text-white">
                                <button id="approveLeave" type="button" class=" text-white items-center justify-between bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-2 me-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                    Approve
                                </button>
                                <button id="rejectLeave" type="button" class=" text-white items-center justify-between bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-2 me-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                    Reject
                                </button>

                                <div id="approved" class="hidden text-white items-center justify-between bg-green-700 font-medium rounded-lg text-sm px-2 py-2 me-2">
                                    Approved
                                </div>

                                <div id="rejected" class="hidden text-white items-center justify-between bg-red-700 font-medium rounded-lg text-sm px-2 py-2 me-2">
                                    Rejected
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>

        <!-- View Documents -->
        <div id="view-documents" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-fit max-h-full">
                <!-- Modal content -->
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

    <script src="{{asset('js/admin-leave-create.js')}}"></script>
</x-admin-layout>
