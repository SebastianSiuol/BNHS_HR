import { zodResolver } from "@hookform/resolvers/zod";
import { useEffect, useState } from "react";
import {
    router,
    usePage,
    useForm as useInertiaForm,
    Link,
} from "@inertiajs/react";
import { useForm, Controller } from "react-hook-form";

import { FileInput } from "@/Components/FileInput";

import { leaveRequestSchema } from "@/Schemas/LeaveSchema";
import CustomDatePicker from "@/Components/CustomDatePicker";

export default function Create() {
    return (
        <>
            <HandlePage />
        </>
    );
}

function HandlePage() {
    const { leaveTypes, serviceCredit } = usePage().props;
    const [serviceCreditValue, setServiceCreditValue] = useState(serviceCredit);

    const {
        register,
        handleSubmit,
        watch,
        control,
        setValue,
        formState: { errors },
    } = useForm({
        resolver: zodResolver(leaveRequestSchema),
    });

    const numberOfDays = watch("no_of_days", 0);
    const leaveType = watch("leave_type");

    useEffect(() => {
        if (leaveType !== "3") {
            setValue("no_of_days", 0);
            setServiceCreditValue(serviceCredit);
        }
    }, [leaveType, setValue, serviceCredit]);

    function updateDays(steps) {
        const newDays = numberOfDays + steps;

        if (newDays >= 0 && newDays <= serviceCredit) {
            setValue("no_of_days", newDays);
            setServiceCreditValue(serviceCredit - newDays);
        }
    }

    function submitLeaveRequest(data, e) {
        e.preventDefault();
        console.log(data)
        router.post(route("faculty.leaves.store"), data);
    }

    return (
        <>
            <div className="sm:flex">
                <div className="relative p-4 w-full max-h-full">
                    <div className="relative bg-white border border-gray-300 rounded-lg shadow">
                        <div className="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                            <h3 className="text-lg font-semibold text-gray-900">
                                Leave Request Form
                            </h3>
                            <Link
                                href={route("faculty.leaves.index")}
                                className={
                                    "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center "
                                }>
                                Back
                            </Link>
                        </div>

                        <form className="p-4 md:p-5">
                            <div className="grid gap-4 mb-4">
                                <div className="mb-4">
                                    <p className="text-gray-900">
                                        Service Credit Balance:{" "}
                                        <span
                                            id="credit-balance"
                                            className="font-bold text-green-600">
                                            {serviceCreditValue}
                                        </span>
                                    </p>
                                    {/* {creditWarning && (
                                        <p
                                            id="credit-warning"
                                            className="text-sm text-red-500">
                                            Insufficient service credits. Taking
                                            leave will result in a pay
                                            deduction.
                                        </p>
                                    )} */}
                                </div>

                                <label className="block text-sm font-medium text-gray-900 ">
                                    Type of Leave
                                </label>
                                <select
                                    {...register("leave_type")}
                                    className="p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    {leaveTypes.map((leaveType) => (
                                        <option
                                            key={leaveType.id}
                                            value={leaveType.id}>
                                            {leaveType.name}
                                        </option>
                                    ))}
                                </select>

                                <div>
                                    <div>
                                        <label className="block mb-2 text-sm font-medium text-gray-900">
                                            From Date
                                            <Controller
                                                control={control}
                                                name="start_date"
                                                render={({ field }) => (
                                                    <CustomDatePicker
                                                        value={field}
                                                        error={errors}
                                                        name="start_date"
                                                    />
                                                )}
                                            />
                                        </label>
                                    </div>
                                </div>
                                {leaveType === "3" && (
                                    <label className="block mb-2 text-sm font-medium text-gray-900">
                                        Number of Days:
                                        <div className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                            <button
                                                onClick={(e) => {
                                                    e.preventDefault();
                                                    updateDays(-1);
                                                }}
                                                className="bg-gray-100 hover:bg-gray-200 rounded-s-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                                                -
                                            </button>

                                            <input
                                                {...register("no_of_days")}
                                                readOnly
                                                className="bg-gray-50 border-x-0 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 mx-12 py-2.5"
                                            />

                                            <button
                                                onClick={(e) => {
                                                    e.preventDefault();
                                                    updateDays(1);
                                                }}
                                                className="bg-gray-100 hover:bg-gray-200 rounded-e-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                                                +
                                            </button>
                                        </div>
                                    </label>
                                )}

                                <div>
                                    <label className="block mb-2 text-sm font-medium text-gray-900">
                                        Required Documents
                                        <Controller
                                            name="leave_document"
                                            control={control}
                                            rules={{
                                                required:
                                                    "Main file is required.",
                                                validate: (file) =>
                                                    file?.size <=
                                                        5 * 1024 * 1024 ||
                                                    "File size exceeds 5MB",
                                            }}
                                            render={({ field }) => (
                                                <FileInput
                                                    file={field.value}
                                                    onFileChange={(file) =>
                                                        field.onChange(file)
                                                    }
                                                />
                                            )}
                                        />
                                    </label>
                                </div>
                            </div>

                            <div className="mt-8 flex items-center justify-center">
                                <button
                                    onClick={handleSubmit(submitLeaveRequest)}
                                    className="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </>
    );
}

// function HandlePage() {
//     const { leaveTypes, serviceCredit } = usePage().props;
//     const [serviceCreditValue, setServiceCreditValue] = useState(serviceCredit);

//     const {
//         register,
//         handleSubmit,
//         watch,
//         control,
//         setValue,
//         formState: { errors },
//     } = useForm({
//         resolver: zodResolver(leaveRequestSchema),
//     });

//     const numberOfDays = watch("no_of_days", 0);
//     const leaveType = watch("leave_type");

//     useEffect(() => {
//         if (leaveType !== "3") {
//             setValue("no_of_days", 0);
//             setServiceCreditValue(serviceCredit);
//         }
//     }, [leaveType, setValue, serviceCredit]);

//     function updateDays(steps) {
//         const newDays = numberOfDays + steps;

//         if (newDays >= 0 && newDays <= serviceCredit) {
//             setValue("no_of_days", newDays);
//             setServiceCreditValue(serviceCredit - newDays);
//         }
//     }

//     function submitLeaveRequest(data, event) {
//         event.preventDefault();

//         router.post(route("faculty.leaves.store"), data);
//     }

//     return (
//         <>
//             <Link href={route("faculty.leaves.index")} className={"text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"}>
//                 Back
//             </Link>
//             <form>
//                 <div className="flex flex-col gap-y-8 my-4 mx-24">
//                     <div className="flex items-center gap-x-8">
//                         <p className="text-lg font-bold">Service Credit:</p>
//                         <span>{serviceCreditValue}</span>
//                     </div>
//                     <div className="grid grid-cols-2 items-center">
//                         <label className="text-lg font-bold">Leave Type:</label>
//                         <span className={"flex"}>
//                             <select {...register("leave_type")} className="grow p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500">
//                                 {leaveTypes.map((leaveType) => (
//                                     <option key={leaveType.id} value={leaveType.id}>
//                                         {leaveType.name}
//                                     </option>
//                                 ))}
//                             </select>
//                         </span>
//                     </div>

//                     <div className="grid grid-cols-2 items-center">
//                         <label className="text-lg font-bold">Start Date:</label>
//                         <Controller control={control} name="start_date" render={({ field }) => <CustomDatePicker value={field} error={errors} name="start_date" />} />
//                     </div>

//                     {leaveType === "3" && (
//                         <div className="grid grid-cols-2 items-center">
//                             <p className="text-lg font-bold">Number of Days:</p>
//                             <div className="flex items-center">
//                                 <button
//                                     onClick={(e) => {
//                                         e.preventDefault();
//                                         updateDays(-1);
//                                     }}
//                                     className="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none"
//                                 >
//                                     -
//                                 </button>

//                                 <input {...register("no_of_days")} readOnly className="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 mx-12 py-2.5" />

//                                 <button
//                                     onClick={(e) => {
//                                         e.preventDefault();
//                                         updateDays(1);
//                                     }}
//                                     className="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none"
//                                 >
//                                     +
//                                 </button>
//                             </div>
//                         </div>
//                     )}

//                     <div className="grid grid-cols-2 items-center">
//                         <label className="text-lg font-bold">Reason for Request</label>
//                         <div>
//                             <textarea {...register("reason")} error={errors} className={"w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-blue-600 focus:border-blue-600 " + (errors["reason"] ? " border-red-500 " : "")} />
//                             {errors["reason"] && (
//                                 <div className={errors ? "block" : "hidden"}>
//                                     <p className="text-red-500 text-sm italic">{errors["reason"]?.message}</p>
//                                 </div>
//                             )}
//                         </div>
//                     </div>
//                     <button
//                         onClick={handleSubmit(submitLeaveRequest)}
//                         className={"text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center"}
//                     >
//                         Submit
//                     </button>
//                 </div>
//             </form>
//         </>
//     );
// }
