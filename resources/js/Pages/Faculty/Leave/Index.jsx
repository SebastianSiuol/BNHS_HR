import { Link, usePage } from "@inertiajs/react";

import { capitalizeFirstLetter } from "@/Utils/stringUtils";

import { ContentContainer } from "@/Components/ContentContainer";
import { Table, TableRow } from "@/Components/Table";
import CustomIcon from "@/Components/CustomIcon";

export default function Index() {
    return (
        <>
            <ContentContainer type={"noOutline"}>
                <HandlePage />
            </ContentContainer>
        </>
    );
}

function HandlePage() {
    return (
        <>
            <div className="flex pb-6 pt-2 justify-end">
                <Link href={route("faculty.leaves.create")} className="bg-blue-700 p-2 text-white rounded-lg hover:bg-blue-900">
                    Request for a Leave
                </Link>
            </div>
            <LeaveTable />
        </>
    );
}

function LeaveTable() {
    const { leaves } = usePage().props;

    function handleView(data) {
        console.log(`view ${data}`);
    }

    function handleEdit(data) {
        console.log(`edit ${data}`);
    }

    function handleDelete(data) {
        console.log(`trash ${data}`);
    }

    const headers = ["Leave Type", "Duration", "Start Date", "Status", "Reason", "Action"];

    const columns = [
        (leave) => leave.leave_types?.name,
        (leave) => leave.leave_types?.days,
        (leave) => leave.start_date,
        (leave) => <p className="text-red-600">{capitalizeFirstLetter(leave.status)}</p>,
        (leave) => leave.reason,
        (leave) => (
            <div className="flex items-center justify-evenly">
                <button onClick={() => handleView(leave.id)}>
                    <CustomIcon type="view" />
                </button>
                <button onClick={() => handleEdit(leave.id)}>
                    <CustomIcon type="edit" />
                </button>
                <button onClick={() => handleDelete(leave.id)}>
                    <CustomIcon type="delete" />
                </button>
            </div>
        ),
    ];

    return <Table data={leaves} headers={headers} renderRow={(leave) => <TableRow key={leave.id} data={leave} columns={columns} />} />;
}
