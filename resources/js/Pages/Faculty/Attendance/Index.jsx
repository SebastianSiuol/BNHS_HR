import { useState, useEffect } from "react";
import { usePage, router } from "@inertiajs/react";
import { Description, DialogTitle } from "@headlessui/react";
import dayjs from "dayjs";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";

import { MdOutlineNoEncryptionGmailerrorred } from "react-icons/md";

import Modal from "@/Components/Modal";

import { capitalizeFirstLetter } from "@/Utils/stringUtils";
import { formatDate } from "@/Utils/customDayjsUtils";

export default function Index() {
    const { auth, shift, attendance } = usePage().props;
    const [currentTime, setCurrentTime] = useState(
        dayjs().format("hh:mm:ss A")
    );
    const [confirmCheckout, setConfirmCheckout] = useState(false);

    const postTime = formatDate(dayjs(), "YYYY-MM-DDTHH:mm:ss");
    const formattedDate = dayjs().format("MMMM DD, YYYY");

    useEffect(() => {
        const timeInterval = setInterval(() => {
            setCurrentTime(dayjs().format("hh:mm:ss A"));
        }, 1000);

        return () => clearInterval(timeInterval);
    }, [setCurrentTime]);

    const handleConfirmCheckoutModal = () => {
        setConfirmCheckout((e) => !e);
    };

    const postTimeOut = () => {
        try {
            router.post(route("faculty.attendances.check-out"), {
                id: auth.id,
                shiftTime: shift.to,
                postTime,
                action: "checkOut",
            }, {
                onSuccess: () => {
                    setConfirmCheckout(false);
                },
            });
        } catch (e) {
            console.log(e);
            errorSwal("Something went wrong! Please try again later.");
        }
    };

    function onTimeIn() {
        try {
            router.post(
                route("faculty.attendances.check-in"),
                {
                    id: auth.id,
                    shiftTime: shift.from,
                    postTime,
                    action: "checkIn",
                },

            );
        } catch (e) {
            console.log(e);
            errorSwal("Something went wrong! Please try again later.");
        }
    }

    function onTimeOut() {

        if ((attendance?.check_in) && (!attendance?.check_out)) {
        const checkInTime = dayjs(attendance?.check_in);
            const checkOutTime = dayjs(postTime);

            if (checkOutTime.diff(checkInTime, "hours") < 8) {
                handleConfirmCheckoutModal();
            } else {
                postTimeOut();
            }
        } else {
            postTimeOut();
        }
    }

    const formatHourTo12H = (hour) => {
        const timeTo12H = dayjs(hour).format("hh:mm A");

        return timeTo12H;
    };

    const formatDateToTime = (date) => {
        const dateToTime = dayjs(date).format("hh:mm A");

        return dateToTime;
    };

    return (
        <>
            <div className="bg-white mb-5 border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
                <h1 className="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                    Daily Attendance
                </h1>

                <section className={"flex items-center mb-5 justify-between"}>
                    <div>
                        <div>
                            <span className={"font-bold"}>Date Today: </span>
                            {formattedDate}
                        </div>
                        <div>
                            <span className={"font-bold"}>Time Today: </span>
                            {currentTime}
                        </div>
                    </div>
                    <div className={"flex space-x-2"}>
                        <button
                            className="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 "
                            onClick={onTimeIn}
                        >
                            Check-in
                        </button>
                        <button
                            className="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 "
                            onClick={onTimeOut}
                        >
                            Check-out
                        </button>
                    </div>
                </section>
                <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table className="w-full text-sm text-left rtl:text-right text-gray-500 ">
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
                        <tbody>
                            <tr className="odd:bg-blue-100 even:bg-white border-b">
                                <td className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {`${formatHourTo12H(
                                        shift.from
                                    )} - ${formatHourTo12H(shift.to)}`}
                                </td>
                                <td
                                    id="timeIn"
                                    className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "
                                >
                                    {attendance?.check_in
                                        ? formatDateToTime(attendance?.check_in)
                                        : "--"}
                                </td>
                                <td
                                    id="timeOut"
                                    className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "
                                >
                                    {attendance?.check_out
                                        ? formatDateToTime(
                                              attendance?.check_out
                                          )
                                        : "--"}
                                </td>
                                <td
                                    id="status"
                                    className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "
                                >
                                    {attendance?.status
                                        ? capitalizeFirstLetter(
                                              attendance?.status
                                          )
                                        : "--"}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <ConfirmCheckout
                state={confirmCheckout}
                onToggle={handleConfirmCheckoutModal}
                onConfirm={postTimeOut}
            />
        </>
    );
}

function ConfirmCheckout({ state, onToggle, onConfirm }) {
    return (
        <Modal state={state} onToggle={onToggle}>
            <DialogTitle
                className="flex font-bold text-2xl text-gray-900 justify-between items-center p-6 pb-2"
                as="div"
            >
                <span>Confirm Check-Out?</span>
                <button onClick={onToggle} className={"text-red-800"}>
                    &times;
                </button>
            </DialogTitle>
            <Description as="div">
                <hr
                    className={"h-[1px] border-none text-gray-400 bg-gray-400"}
                />

                <div className={"px-12 py-6"}>
                    <p className={"text-lg"}>
                        You are about to check-out earlier than expected!
                    </p>
                    <p className={"text-md font-medium text-red-800 text-end"}>
                        Continue?*
                    </p>
                </div>
                <div className={"flex justify-between px-12 mb-8"}>
                    <button
                        onClick={onToggle}
                        className={
                            "py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100"
                        }
                    >
                        Cancel
                    </button>
                    <button
                        onClick={onConfirm}
                        className={
                            "text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                        }
                    >
                        Check-Out
                    </button>
                </div>
            </Description>
        </Modal>
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
