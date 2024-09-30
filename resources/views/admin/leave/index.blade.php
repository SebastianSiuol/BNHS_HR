<x-admin-layout :admin="$admin">


<x-slot:heading>Leave Manage</x-slot:heading>

    <main class="block h-full p-4 sm:ml-80">
        <div class="flex items-center pb-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-9 h-9 text-blue-900">
                <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
            <h1 class="text-3xl text-blue-900 font-bold ml-2">Manage Leave</h1>
        </div>

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
                        <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Ryan Basilides</a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Sebastian Torio</a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Rogelio Herbosa</a>
                            </td>
                        </tr>
                        <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Ryan Basilides</a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Sebastian Torio</a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Rogelio Herbosa</a>
                            </td>
                        </tr>
                        <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Ryan Basilides</a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Sebastian Torio</a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Rogelio Herbosa</a>
                            </td>
                        </tr>
                        <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Ryan Basilides</a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Sebastian Torio</a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Rogelio Herbosa</a>
                            </td>
                        </tr>
                        <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Ryan Basilides</a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Sebastian Torio</a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Rogelio Herbosa</a>
                            </td>
                        </tr>
                        <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Ryan Basilides</a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Sebastian Torio</a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="text-blue-600 underline hover:text-blue-900">Rogelio Herbosa</a>
                            </td>
                        </tr>
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
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            5 Days
                        </td>
                    </tr>
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
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            5 Days
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>


    </main>
</x-admin-layout>
