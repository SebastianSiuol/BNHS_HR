import { usePage, router } from "@inertiajs/react";
import { useState } from "react";
import dayjs from "dayjs";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";

import { MdOutlineNoEncryptionGmailerrorred } from "react-icons/md";

const AUTH_API_KEY = import.meta.env.VITE_AUTH_API_KEY;

const currentTime = dayjs().format("YYYY-MM-DDTHH:mm:ss.SSS");
const postUrl = "/api/attendance/action";

export default function Index() {
    return (
        <>
            <HandlePage />
        </>
    );
}

function HandlePage() {
    const { shift, auth } = usePage().props;

    async function onTimeIn() {
        try {
            const response = await fetch(postUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "x-auth-api-key": AUTH_API_KEY,
                },
                body: JSON.stringify(
                    postFormat({
                        id: auth.id,
                        shiftTime: shift.from,
                        postTime: currentTime,
                        action: "check_in",
                    })
                ),
            });

            const parsedResponse = await response.json();

            if (!response.ok) {
                errorSwal(parsedResponse.error);
            }
        } catch (e) {
            errorSwal("Something went wrong!");
        }
    }

    function onTimeOut() {}

    function formatTimeTo12H(hour) {
        const timeTo12H = dayjs("1/1/1 " + hour).format("hh:mm A");

        return timeTo12H;
    }

    return (
        <>
            <div
                id="dailyAttendance-filter"
                className="bg-white mb-5 border w-full border-blue-900 rounded-md shadow sm:p-8 p-6"
            >
                <h1 className="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                    Daily Attendance
                </h1>

                <div className="flex items-center mb-5 justify-end">
                    {/* <div>
                        <p
                            id="holidayMessage"
                            className="text-red-500 font-medium hidden"
                        >
                            Today is a holiday
                        </p>
                    </div> */}
                    <div className={"flex space-x-2"}>
                        <button
                            className="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 "
                            onClick={onTimeIn}
                        >
                            Time In
                        </button>
                        <button
                            className="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 "
                            onClick={onTimeOut}
                        >
                            Time Out
                        </button>
                    </div>
                </div>
                <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table
                        id="default-table"
                        className="w-full text-sm text-left rtl:text-right text-gray-500 "
                    >
                        <thead className="text-sm text-white bg-blue-900  ">
                            <tr>
                                <th scope="col" className="px-6 py-3">
                                    Shift
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Time In
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Time Out
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody id="attendanceBody">
                            <tr className="odd:bg-blue-100 even:bg-white border-b">
                                <td className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {`${formatTimeTo12H(
                                        shift.from
                                    )} - ${formatTimeTo12H(shift.to)}`}
                                </td>
                                <td
                                    id="timeIn"
                                    className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "
                                >
                                    --
                                </td>
                                <td
                                    id="timeOut"
                                    className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "
                                >
                                    --
                                </td>
                                <td
                                    id="status"
                                    className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "
                                >
                                    --
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </>
    );
}

function errorSwal(error) {
    withReactContent(Swal).fire({
        title: <b>ERROR</b>,
        iconHtml: <MdOutlineNoEncryptionGmailerrorred />,
        text: error,
        confirmButtonText: "Confirm",
        customClass: {
            container: "...",
            popup: "border rounded-3xl",
            header: "...",
            title: "text-gray-500",
            icon: "...",
            htmlContainer: "...",
            validationMessage: "...",
            actions: "...",
            confirmButton: "bg-blue-800",
        },
    });
}
