<x-staff.layout :with_nav="false">

    <x-staff.content-panel>
        <div class="flex justify-between">
            <h3 class="text-blue-800 text-3xl font-bold">Manage Leave</h3>
            <a href="/staff/leave/create">
                <button type="submit" class="bg-blue-700 p-2 text-white rounded-lg hover:bg-blue-900">Apply for a Leave</button>
            </a>
        </div>
        <x-divider/>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="default-table" class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-sm text-white bg-blue-900  ">
                <tr>
                    <th class="px-6 py-3">
                        Leave Type
                    </th>
                    <th class="px-6 py-3">
                        Duration
                    </th>
                    <th class="px-6 py-3">
                        Date
                    </th>
                    <th class="px-6 py-3">
                        Status
                    </th>
                    <th class="px-6 py-3">
                        Reason
                    </th>
                    <th class="px-6 py-3">
                        Action
                    </th>
                </tr>
                </thead>

                <tbody>

                <!-- START OF ROWS -->
                @for($i = 0; $i < 5; $i++)
                    <tr class="odd:bg-blue-100 odd: even:bg-white even:border-b ">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Maternal Leave
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            14 Days
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            01-01-1970
                        </td>
                        <td class="px-6 py-4 font-medium text-green-900 whitespace-nowrap">
                            Active
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Ako'y may anak
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <div class="flex items-center justify-end">

                                <button data-modal-target="#" data-modal-toggle="#" type="button">
                                    <svg class="w-[27px] h-[27px] text-green-600 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                        <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    </svg>
                                </button>

                                <a href="#">
                                    <svg class="w-[27px] h-[27px] text-blue-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                                        <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                                    </svg>
                                </a>

                                <button data-modal-target="#" data-modal-toggle="#">
                                    <svg class="w-[27px] h-[27px] text-red-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>

                            </div>
                        </td>
                    </tr>


                @endfor
                <!-- END OF ROW -->
                </tbody>
            </table>
        </div>





    </x-staff.content-panel>

</x-staff.layout>
