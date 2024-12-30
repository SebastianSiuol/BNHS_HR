import { useState, useEffect, useCallback } from "react";
import { usePage, router } from "@inertiajs/react";

import {  FaEye } from 'react-icons/fa';


import { PageHeaders } from "@/Components/Admin/PageHeaders";
import { ContentContainer } from "@/Components/ContentContainer";
import { ContentHeader } from "@/Components/ContentHeader";
import { Table, TableRow } from "@/Components/Table";
import CustomIcon from "@/Components/CustomIcon";
import Pagination from "@/Components/Pagination";

import { capitalizeFirstLetter } from '@/Utils/stringUtils';
import { getFullName, handleLeaveStatus } from '@/Utils/formatTableDataUtils';

export default function Approve() {
    return (
        <>
            <PageHeaders>Manage Leave</PageHeaders>
            <ContentContainer>
                <ContentHeader>
                    Leave Requests
                </ContentHeader>
                <HandlePage />
            </ContentContainer>
        </>
    );
}

function HandlePage() {

    const { leaveRequests } = usePage().props;


    return (
        <>
                <LeavesTable data={leaveRequests.data}/>
                <Pagination data={leaveRequests} />

        </>
    );
}


function LeavesTable({ data }) {

    // Headers
    const headers = [
        "Faculty Name",
        "Leave Type",
        "Start Date",
        "End Date",
        "Service Credits",
        "Documents",
        "Status",
        "Actions",
    ];



    function renderActions( status, leaveRequestId) {
        function handleApprove(id){
            console.log(id);
            router.patch(route('admin.leaves.manage.action', id), {action: 'approve'})
        }
        function handleReject(id){
            console.log(id);
            router.patch(route('admin.leaves.manage.action', id), {action: 'reject'})
        }



        switch (status) {
            case "pending":
                return (
                    <div className={"flex flex-col space-y-2"}>
                        <button
                            onClick={()=>{handleApprove(leaveRequestId)}}
                            className={
                                "text-white items-center justify-between bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm p-2 me-2"
                            }>
                            Approve
                        </button>
                        <button
                            onClick={()=>{handleReject(leaveRequestId)}}
                            className={
                                "text-white items-center justify-between bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm p-2 me-2"
                            }>
                            Reject
                        </button>
                    </div>
                );
            case "approved":
                return (
                    <div
                        className={"text-white text-center bg-green-700 font-medium rounded-lg text-sm p-2 me-2"}>
                        Approved
                    </div>
                );
            case "rejected":
                return (
                    <div className={"text-white text-center bg-red-700 font-medium rounded-lg text-sm p-2 me-2"}>
                        Rejected
                    </div>
                );
            case "ongoing":
                return (
                    <div
                        className={"text-white text-center bg-green-700 font-medium rounded-lg text-sm p-2 me-2"}>
                        Approved
                    </div>
                );
                case "cancelled":
                    return (
                        <div
                            className={"text-white text-center bg-orange-700 font-medium rounded-lg text-sm p-2 me-2"}>
                            Cancelled
                        </div>
                    );
            default:
                return null;
        }
    }

    // Headers
    const columns = [
        (leaveRequest) => getFullName(leaveRequest.faculty.personal_information),
        (leaveRequest) => leaveRequest.leave_types.name,
        (leaveRequest) => leaveRequest.start_date,
        (leaveRequest) => leaveRequest.end_date,
        (leaveRequest) => leaveRequest.faculty.service_credit,
        (leaveRequest) => (
            <div>
                <button className={'text-white flex items-center justify-between bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-1 py-1 me-2'}>
                    <FaEye className={'w-[20px] h-[20px] text-white'}/>
                    View Document
                </button>
            </div>
        ),
        (leaveRequest) => handleLeaveStatus(capitalizeFirstLetter(leaveRequest.status)),
        (leaveRequest) => renderActions(leaveRequest.status, leaveRequest.id),
    ];
    return (
        <Table
            data={data}
            headers={headers}
            renderRow={(leaveRequest) => (
                <TableRow
                    key={leaveRequest.id}
                    data={leaveRequest}
                    columns={columns}
                />
            )}
        />
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