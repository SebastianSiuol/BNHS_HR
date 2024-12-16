import { useState } from "react";

import { PageHeaders } from "@/Components/Admin/PageHeaders";
import { ContentContainer } from "@/Components/ContentContainer";
import { FaRegEye } from "react-icons/fa6";


export default function Approve() {
    return (
        <>
            <PageHeaders>Manage Leave</PageHeaders>
            <ContentContainer>
                <HandlePage />
            </ContentContainer>
        </>
    );
}

function HandlePage() {
    return (
        <>
            <div>
                <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                    Leave Requests
                </h1>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table
                        id="default-table"
                        class="w-full text-sm text-left rtl:text-right text-gray-500 "
                    >
                        <thead class="text-sm text-white bg-blue-900  ">
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
                            <tr class="odd:bg-blue-100 even:bg-white border-b ">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    John Doe
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    Paternal Leave
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    Jan 01 2024
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    Jan 15 2024
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    8
                                </td>
                                <td class="px-6 py-4 font-medium text-green-500 whitespace-nowrap ">
                                    <button
                                        type="button"
                                        class="text-white flex items-center justify-between bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-2 py-2 me-2 "
                                    >
                                            <FaRegEye type="view" class="w-[27px] h-[27px] text-white-600 "/>

                                        View Documents
                                    </button>
                                </td>

                                <td class="px-6 py-4 font-medium text-green-500 whitespace-nowrap ">
                                    Pending
                                </td>
                                <td class="sm:flex px-6 py-4 font-medium text-green-500 whitespace-nowrap ">
                                    <button
                                        id="approveLeave"
                                        type="button"
                                        class=" text-white items-center justify-between bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-2 me-2 "
                                    >
                                        Approve
                                    </button>
                                    <button
                                        id="rejectLeave"
                                        type="button"
                                        class="text-white items-center justify-between bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-2 me-2"
                                    >
                                        Reject
                                    </button>

                                    <div
                                        id="approved"
                                        class="hidden text-white items-center justify-between bg-green-700 font-medium rounded-lg text-sm px-2 py-2 me-2"
                                    >
                                        Approved
                                    </div>

                                    <div
                                        id="rejected"
                                        class="hidden text-white items-center justify-between bg-red-700 font-medium rounded-lg text-sm px-2 py-2 me-2"
                                    >
                                        Rejected
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </>
    );
}


function DocumentModal(){


    return (
        <div class="relative p-4 w-fit max-h-full">
            <div class="relative bg-gray-100 items-center justify-center rounded-lg shadow ">
                <div class="flex mb items-center justify-between p-4 md:p-5 border-b rounded-t ">
                    <h3 class="text-lg font-semibold text-gray-900 ">
                        Documents
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-toggle="view-documents">
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
    );
}