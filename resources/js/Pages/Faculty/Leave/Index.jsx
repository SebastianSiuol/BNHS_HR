import { useState, useEffect, useCallback } from "react";
import { Link, usePage, router } from "@inertiajs/react";
import dayjs from "dayjs";

// Components
import Modal from "@/Components/Modal";
import CustomIcon from "@/Components/CustomIcon";
import Pagination from "@/Components/Pagination";
import { ContentContainer } from "@/Components/ContentContainer";
import { ContentHeader } from "@/Components/ContentHeader";
import { Table, TableRow } from "@/Components/Table";
import { Description, DialogTitle } from "@headlessui/react";


// Utilities
import { handleStatus } from "@/Utils/formatTableDataUtils";
import { capitalizeFirstLetter } from "@/Utils/stringUtils";

export default function Index() {
    return (
        <>
            <ContentContainer>
            <ContentHeader> Request Leave</ContentHeader>
                <HandlePage />
            </ContentContainer>
        </>
    );
}

function HandlePage() {
    const { leaves, serviceCredit } = usePage().props;
    const [selectedLeave, setSelectedLeave] = useState(null);
    const [cancelModal, setCancelModal] = useState(false);
    const [viewModal, setViewModal] = useState(false);

    const handleViewModal = (id) => {
        setSelectedLeave(leaves?.data.find((leave) => leave.public_id === id));
        setViewModal((e) => !e);
    };

    const handleCancelModal = (id) => {
        setSelectedLeave(leaves?.data.find((leave) => leave.public_id === id));
        setCancelModal((e) => !e);
    };


    return (
        <>
            <div className="flex justify-between items-center">
                <div className="mb-4">
                    <p className="text-gray-900">
                        Service Credit Balance:{" "}
                        <span
                            id="credit-balance"
                            className="font-bold text-green-600">
                            {serviceCredit}
                        </span>
                    </p>
                </div>
                <div className="flex pb-6 pt-2 justify-end">
                    <Link
                        href={route("faculty.leaves.create")}
                        className="bg-blue-700 p-2 text-white rounded-lg hover:bg-blue-900">
                        Request for a Leave
                    </Link>
                </div>
            </div>
            <LeaveTable data={leaves?.data} onCancel={handleCancelModal} onView={handleViewModal} />
            <Pagination data={leaves}/>
            <ViewModal state={viewModal} onToggle={handleViewModal} selectedData={selectedLeave} />
            <CancelModal state={cancelModal} onToggle={handleCancelModal} selectedData={selectedLeave} />
        </>
    );
}



function LeaveTable({ data, onCancel, onView }) {

    function handleView(leaveId) {
        onView(leaveId);

    }

    function handleCancel(leaveId) {
        onCancel(leaveId);
    }


    const headers = ["Leave Type", "Start Date", "End Date", "Status", "Action"];

    const columns = [
        (leave) => leave.leave_types?.name,
        // (leave) => leave.leave_types?.days,
        (leave) => leave.start_date,
        (leave) => leave.end_date,
        (leave) => handleStatus(capitalizeFirstLetter(leave.status)),
        (leave) => (
            <div className="flex items-center justify-evenly">
                <button onClick={() => handleView(leave.public_id)}>
                    <CustomIcon type="view" />
                </button>
                <button onClick={() => handleCancel(leave.public_id)}>
                    <CustomIcon type="cancel" />
                </button>
            </div>
        ),
    ];

    return (
        <Table
            data={data}
            headers={headers}
            renderRow={(leave) => (
                <TableRow
                    key={leave.public_id}
                    data={leave}
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

function CancelModal({ state, onToggle, selectedData }) {
    function handleAttendanceCancellation() {
        const payload = {
            action: 'cancel',
        }
        router.patch(route("leaves.patch.cancel", selectedData?.public_id), payload, {
                onSuccess: () => {
                    onToggle();
                },
            }
        );
    }

    return (
        <Modal
            state={state}
            onToggle={onToggle}>
            <DialogTitle className="flex font-bold text-2xl text-gray-900 justify-between items-center p-4">
                <span>
                    Confirm <span className={"font-bold text-red-900"}>cancellation?</span>
                </span>
                <button
                    onClick={onToggle}
                    className={"text-red-800"}>
                    &times;
                </button>
            </DialogTitle>
            <Description as={"div"}>
                <hr />
                <div className={"flex mx-24 my-12 "}>
                    <p className={"text-lg"}>Cancel this leave request?</p>
                </div>

                <div className={"flex justify-end px-12 mb-8"}>
                    <button
                        onClick={handleAttendanceCancellation}
                        className={
                            "text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                        }>
                        Yes
                    </button>
                    <button
                        onClick={onToggle}
                        className={
                            "py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100"
                        }>
                        No
                    </button>
                </div>
            </Description>
        </Modal>
    );
}