import { useState, useEffect, useCallback } from "react";
import { Link, usePage, router } from "@inertiajs/react";

// Components
import Modal from "@/Components/Modal";
import CustomIcon from "@/Components/CustomIcon";
import Pagination from "@/Components/Pagination";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";
import { ContentContainer } from "@/Components/ContentContainer";
import { Table, TableRow } from "@/Components/Table";
import { Description, DialogTitle } from "@headlessui/react";


// Utilities
import { handleLeaveStatus } from "@/Utils/formatTableDataUtils";
import { capitalizeFirstLetter } from "@/Utils/stringUtils";

export default function Index() {
    return (
        <>
            <PageHeaders>Request Leave</PageHeaders>
            <ContentContainer type={"noOutline"}>
                <HandlePage />
            </ContentContainer>
        </>
    );
}

function HandlePage() {
    const { leaves } = usePage().props;
    const [selectedLeave, setSelectedLeave] = useState(null);
    const [openCancelModal, setOpenCancelModal] = useState(false);

    const handleCancelModal = (id) => {
        setSelectedLeave(leaves?.data.find((leave) => leave.id === id));
        setOpenCancelModal((e) => !e);
    };

    return (
        <>
            <div className="flex pb-6 pt-2 justify-end">
                <Link
                    href={route("admin.leaves.create")}
                    className="bg-blue-700 p-2 text-white rounded-lg hover:bg-blue-900">
                    Request for a Leave
                </Link>
            </div>
            <LeaveTable data={leaves?.data} handleCancelClick={handleCancelModal} />
            <Pagination data={leaves}/>
            <CancelModal state={openCancelModal} onToggle={handleCancelModal} selectedData={selectedLeave} />
        </>
    );
}

function LeaveTable({ data, handleCancelClick }) {

    function handleView(data) {
        console.log(`view ${data}`);
    }

    function handleEdit(data) {
        console.log(`edit ${data}`);
    }

    function handleCancel(leaveId) {
        handleCancelClick(leaveId);
    }

    const headers = ["Leave Type", "Duration", "Start Date", "Status", "Reason", "Action"];

    const columns = [
        (leave) => leave.leave_types?.name,
        (leave) => leave.leave_types?.days,
        (leave) => leave.start_date,
        (leave) => handleLeaveStatus(capitalizeFirstLetter(leave.status)),
        (leave) => leave.reason,
        (leave) => (
            <div className="flex items-center justify-evenly">
                <button onClick={() => handleView(leave.id)}>
                    <CustomIcon type="view" />
                </button>
                <button onClick={() => handleEdit(leave.id)}>
                    <CustomIcon type="edit" />
                </button>
                <button onClick={() => handleCancel(leave.id)}>
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
                    key={leave.id}
                    data={leave}
                    columns={columns}
                />
            )}
        />
    );
}


function CancelModal({ state, onToggle, selectedData }) {
    function handleAttendanceCancellation() {
        const payload = {
            action: 'cancel',
        }
        router.patch(route("admin.leaves.patch.cancel", selectedData?.id), payload, {
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