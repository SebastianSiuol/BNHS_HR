import { useState, useEffect, useCallback } from "react";
import { usePage, router } from "@inertiajs/react";
import dayjs from "dayjs";
import {  FaEye } from 'react-icons/fa';

// Components
import Modal from "@/Components/Modal";
import { Description, DialogTitle } from "@headlessui/react";

import { PageHeaders } from "@/Components/Admin/PageHeaders";
import { ContentContainer } from "@/Components/ContentContainer";
import { ContentHeader } from "@/Components/ContentHeader";
import { Table, TableRow } from "@/Components/Table";
import CustomIcon from "@/Components/CustomIcon";
import Pagination from "@/Components/Pagination";

import { capitalizeFirstLetter } from '@/Utils/stringUtils';
import { getFullName, handleStatus } from '@/Utils/formatTableDataUtils';

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
    const [selectedLeave, setSelectedLeave] = useState(null);
    const [viewModal, setViewModal] = useState(false);


    const handleViewModal = (id) => {
        setSelectedLeave(leaveRequests?.data.find((leave) => leave.public_id === id));
        setViewModal((e) => !e);
    };

    return (
        <>
            <LeavesTable data={leaveRequests.data} onView={handleViewModal}/>
            <Pagination data={leaveRequests} />
            <ViewModal state={viewModal} onToggle={handleViewModal} selectedData={selectedLeave} />
        </>
    );
}


function LeavesTable({ data, onView }) {

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

    function handleView(publicId){
        onView(publicId);
    }



    function renderActions( status, leaveRequestId) {
        function handleApprove(id){
            router.patch(route('admin.leaves.manage.action', id), {action: 'approve'})
        }
        function handleReject(id){
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
                <button
                    onClick={()=>{handleView(leaveRequest.public_id)}}
                    className={'text-white flex items-center justify-between bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-1 py-1 me-2'}>
                    <FaEye className={'w-[20px] h-[20px] text-white'}/>
                    View Document
                </button>
            </div>
        ),
        (leaveRequest) => handleStatus(capitalizeFirstLetter(leaveRequest.status)),
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


function ViewModal({ state, onToggle, selectedData }) {

    const [leaveData, setLeaveData] = useState(null);


    useEffect(() => {
        async function fetchData() {
            if (selectedData) {
                const response = await fetch(
                    route("leaves.show", selectedData?.public_id)
                );
                const parsedResponse = await response.json();

                setLeaveData(parsedResponse);
            }

        }
        fetchData();
    }, [selectedData]);

    const formatDate = (date) => {
        return dayjs(date).format('MMMM D, YYYY')
    }

    return (
        <Modal
            state={state}
            onToggle={onToggle}>
            <DialogTitle className="flex font-bold text-2xl text-gray-900 justify-between items-center p-4">
                <span>
                    View Leave
                </span>
                <button
                    onClick={onToggle}
                    className={"text-red-800"}>
                    &times;
                </button>
            </DialogTitle>
            <Description as={"div"} className={'w-[80vw]'}>
                <hr />
                <div className={"mx-24 my-6 "}>
                    <p ><span className={'font-bold'}>Start date: </span>{formatDate(leaveData?.startDate)}</p>
                    <p ><span className={'font-bold'}>End date: </span>{formatDate(leaveData?.endDate)}</p>
                </div>
                <iframe
                    src={leaveData?.document}
                    width={'100%'}
                    height={"600px"}></iframe>
            </Description>
        </Modal>
    );
}