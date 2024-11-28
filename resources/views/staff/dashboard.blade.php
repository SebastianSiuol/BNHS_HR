<x-staff.layout>

    <!-- Welcome Mes-+sage -->
    <section class="bg-white shadow-md rounded-lg mr-5 p-6 min-w-96">
        <div class="flex">
            <h2 class="text-2xl font-semibold pt-5 pl-3 mb-5 mr-3">Hi there, {{ $auth->personal_information->first_name. "!" }}</h2>
            <img src="wave2.png" class="h-12 mt-3 animate-wave" alt="Waving Hand">
        </div>

        <!-- Attendance Status -->
        <section class=" p-6">
            <h2 class="text-lg font-medium">Attendance Status</h2>
            <p class="mt-4 text-green-600">Present</p>
        </section>

        <!-- Recent Requests -->
        <section class=" p-6">
            <h2 class="text-lg font-medium">Recent Requests</h2>
            <ul class="mt-4 space-y-2">
                <li class="text-gray-600">Leave Request - <span class="text-yellow-400">Pending</span></li>
                <li class="text-gray-600">Attendance Correction - <span class="text-green-400">Approved</span></li>
                <li class="text-gray-600">Others - <span class="text-red-600">Rejected</span></li>
            </ul>
        </section>

    </section>

    <div class="w-full">
        <div class="sm:grid grid-cols-2 gap-6 max-w-7xl mb-5">
            <!-- Daily Schedule -->
            <section class="bg-white shadow-md rounded-lg p-6 py-8">
                <div class="flex pt-1 pl-1">
                    <svg class=" w-9 h-8 text-blue-700 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z"/>
                    </svg>
                    <h2 class="text-xl font-semibold mt-1">Daily Schedule</h2>
                </div>
                <div class="mt-4 ml-4">
                    <table class="w-full text-gray-600">
                        <thead>
                        <tr>
                            <th class="py-2">Time</th>
                            <th class="py-2">Activity</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="py-2">9:00 AM - 10:00 AM</td>
                            <td class="py-2">Team Meeting</td>
                        </tr>
                        <tr>
                            <td class="py-2">10:30 AM - 12:00 PM</td>
                            <td class="py-2">Project Development</td>
                        </tr>                                    <tr>
                            <td class="py-2">10:30 AM - 12:00 PM</td>
                            <td class="py-2">Project Development</td>
                        </tr>
                        <tr>
                            <td class="py-2">10:30 AM - 12:00 PM</td>
                            <td class="py-2">Project Development</td>
                        </tr>
                        <tr>
                            <td class="py-2">10:30 AM - 12:00 PM</td>
                            <td class="py-2">Project Development</td>
                        </tr>
                        <tr>
                            <td class="py-2">10:30 AM - 12:00 PM</td>
                            <td class="py-2">Project Development</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Upcoming Holidays -->
            <section class="bg-white shadow-md rounded-lg p-6 py-8">
                <div class="flex pt-1 pl-1 mb-6">
                    <svg class="w-9 h-8 text-blue-700 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                    </svg>
                    <h2 class="text-xl font-semibold mt-1">Upcoming Holidays</h2>
                </div>
                <ul class="space-y-2 mt-4 ml-4">
                    <li class="text-gray-600">Independence Day - July 4</li>
                    <li class="text-gray-600">Labor Day - September 5</li>
                    <li class="text-gray-600">Thanksgiving - November 24</li>
                </ul>
            </section>
        </div>

        <!-- Announcements and Updates -->
        <section class="bg-white shadow-md rounded-lg p-6 py-8">
            <div class="flex pt-1 pl-1 mb-6">
                <svg class="w-10 h-10 text-blue-700 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M18.458 3.11A1 1 0 0 1 19 4v16a1 1 0 0 1-1.581.814L12 16.944V7.056l5.419-3.87a1 1 0 0 1 1.039-.076ZM22 12c0 1.48-.804 2.773-2 3.465v-6.93c1.196.692 2 1.984 2 3.465ZM10 8H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6V8Zm0 9H5v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3Z" clip-rule="evenodd"/>
                </svg>

                <h2 class="text-xl font-semibold mt-2">Announcements and Updates</h2>
            </div>

            <div class="p-5 bg-gray-200 border-t-2 border-t-gray-300">

                <!-- Main modal -->
                <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Create New Announcement
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form class="p-4 md:p-5">
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Announcement Title</label>
                                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Announcement title" required="">
                                    </div>
                                    <div class="col-span-2">
                                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                        <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Description..."></textarea>
                                    </div>

                                    <div class="col-span-2">
                                        <label for="joining-letter" class="block mr-8 mb-2 text-sm font-medium text-gray-900 ">Attach File</label>
                                        <input class="block w-full mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   " id="file_1" type="file">
                                        <input class="hidden w-full mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   " id="file_2" type="file">
                                        <input class="hidden w-full mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   " id="file_3" type="file">
                                        <input class="hidden w-full mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   " id="file_4" type="file">
                                        <input class="hidden w-full mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   " id="file_5" type="file">
                                    </div>
                                    <div class="flex items-center justify-center col-span-2">
                                        <button id="add-file" type="button">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-end">
                                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Publish
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <ul class="mt-4 space-y-2">
                    <li>
                        <button class="block text-left w-full h-full bg-white border border-gray-200 rounded-lg shadow p-4 transform transition duration-500 hover:scale-105">
                            <strong class="font-semibold text-gray-900">Announcement A</strong>

                            <p class="mt-1 text-xs font-medium text-gray-800">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime consequuntur deleniti,
                                unde ab ut in!
                            </p>
                        </button>
                    </li>
                    <li>
                        <button class="block text-left w-full h-full bg-white border border-gray-200 rounded-lg shadow p-4 transform transition duration-500 hover:scale-105">
                            <strong class="font-semibold text-gray-900">Announcement B</strong>

                            <p class="mt-1 text-xs font-medium text-gray-800">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime consequuntur deleniti,
                                unde ab ut in!
                            </p>
                        </button>
                    </li>
                    <li>
                        <button class="block text-left w-full h-full bg-white border border-gray-200 rounded-lg shadow p-4 transform transition duration-500 hover:scale-105">
                            <strong class="font-semibold text-gray-900">Announcement C</strong>

                            <p class="mt-1 text-xs font-medium text-gray-800">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime consequuntur deleniti,
                                unde ab ut in!
                            </p>
                        </button>
                    </li>
                </ul>
            </div>

        </section>

    </div>


</x-staff.layout>

{{--    <x-staff.content-panel>--}}
{{--        <h3 class="text-blue-800 text-3xl font-bold"> Hello, John Doe </h3>--}}
{{--        <x-divider/>--}}

{{--        <div class="px-20">--}}
{{--            <h1 class="text-4xl ">Announcements</h1>--}}

{{--            <div class="grid grid-cols-0 lg:grid-cols-2 gap-4 mt-8 px-6">--}}
{{--                <x-staff.announcement-card/>--}}
{{--                <x-staff.announcement-card/>--}}
{{--                <x-staff.announcement-card/>--}}
{{--                <x-staff.announcement-card/>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </x-staff.content-panel>--}}
