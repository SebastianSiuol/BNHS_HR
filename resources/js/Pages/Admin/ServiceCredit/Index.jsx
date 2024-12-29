import { useState, useEffect, useCallback } from "react";
import { useForm, Controller } from "react-hook-form";
import { useForm as useInertiaForm } from "@inertiajs/react";
import { usePage, router } from "@inertiajs/react";
import dayjs from "dayjs";
import { Description, DialogTitle } from "@headlessui/react";

import CustomDatePicker from "@/Components/CustomDatePicker";
import { FaPlusCircle, FaTimesCircle } from "react-icons/fa";

import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";
import { FacultyAutoComplete } from '@/Components/FacultyAutoComplete';

export default function Index() {
    return (
        <>
            <PageHeaders>Manage Service Credits</PageHeaders>
            <HandlePage />
        </>
    );
}

function HandlePage() {
    return (
        <>
            <CreditCalculation />
            <ManualAdjustment />
        </>
    );
}

function CreditCalculation() {
    const [selectedFaculties, setSelectedFaculties] = useState([]);

     const {
            register,
            handleSubmit,
            control,
            formState: { errors },
        } = useForm({
            defaultValues: {
                hours_worked: '1',
                date: dayjs().toDate().toDateString(),
            }
        });


        function handleSelection(faculty){
            console.log(selectedFaculties);
            console.log(selectedFaculties.includes(faculty.id));
            if (faculty && !selectedFaculties.some((f) => f.id === faculty.id)) {
                setSelectedFaculties([...selectedFaculties, faculty]);
            }
        }

        function handleRemoveFaculty(facultyToRemove) {
            setSelectedFaculties(
                selectedFaculties.filter((faculty) => faculty !== facultyToRemove)
            );
        }

        function handleCreditCalculation(data, e){
            e.preventDefault();
            const payloads = {
                selected_faculties: selectedFaculties?.map((faculty)=>({ id: faculty.id, faculty_code: faculty.faculty_code })),
                date: data.date,
                hours_worked: data.hours_worked,
            }
            router.post(route('admin.service-credits.store.calc'), payloads,{
                onSuccess: ()=>{
                    setSelectedFaculties([]);
                }
            })
        }

    return (
        <div className="sm:flex">
            <div className="relative p-4 w-full max-h-full">
                <div className="relative bg-white border border-gray-300 rounded-lg shadow ">
                    <div className="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                        <h3 className="text-lg font-semibold text-gray-900 ">Service Credit Calculation</h3>
                    </div>
                    <form className="p-4 md:p-5">
                        <div className="grid gap-4 mb-4">
                            <div>
                                <label className="block mb-2 text-sm font-medium text-gray-900 ">Faculty Name</label>

                                <FacultyAutoComplete selected={null} setSelected={handleSelection} />
                            </div>

                            <div>
                                <label className="block mb-2 text-sm font-medium text-gray-900">
                                    Selected Faculties:
                                </label>
                                <div>
                                    {selectedFaculties?.map((faculty, index) => (
                                        <div
                                            key={index}
                                            className="flex justify-between items-center space-x-2 border border-gray-400 bg-gray-100 p-2 rounded-lg mb-2"
                                        >
                                            <span>{`[${faculty?.faculty_code}] ${faculty?.personal_information?.first_name} ${faculty?.personal_information?.last_name}`}</span>
                                            <button
                                                type="button"
                                                className="text-red-700 hover:text-red-600 hover:scale-125 transition-all"
                                                onClick={() =>
                                                    handleRemoveFaculty(faculty)
                                                }
                                            >
                                                <FaTimesCircle />
                                            </button>
                                        </div>
                                    ))}
                                </div>
                            </div>

                            <div>
                                <label className="block mb-2 text-sm font-medium text-gray-900 ">
                                    Date
                                    <Controller
                                        control={control}
                                        name={"date"}
                                        render={({ field }) => (
                                            <CustomDatePicker
                                                value={field}
                                                error={errors}
                                                minimumDate={'2000-01-01'}
                                            />
                                        )}
                                    />
                                </label>
                            </div>
                            <div className="grid gap-4 grid-cols-2">
                                <div >
                                    <label className="block mr-8 mb-2 text-sm font-medium text-gray-900 ">
                                        Activity
                                        <select className="select-validate bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
                                            <option value="act_01">Activity 1</option>
                                        </select>
                                    </label>
                                </div>
                                <div>
                                    <label className="block mb-2 text-sm font-medium text-gray-900 ">
                                        Hours Worked
                                        <input
                                            {...register('hours_worked')}
                                            type="number"
                                            min="1"
                                            max="48"
                                            className="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     "
                                            required
                                        />
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div className="mt-8 flex items-center justify-center">
                            <button
                                onClick={handleSubmit(handleCreditCalculation)}
                                className="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Calculate
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
}

function ManualAdjustment() {
    const [selectedFaculties, setSelectedFaculties] = useState([]);
    const [creditAction, setCreditAction] = useState(null);

    const {
        register,
        handleSubmit,
        reset,
    } = useForm({
        defaultValues: {
            serviceCredits: '1',
        },
    });

    function handleSelection(faculty) {
        console.log(selectedFaculties.includes(faculty.id));
        if (faculty && !selectedFaculties.some((f) => f.id === faculty.id)) {
            setSelectedFaculties([...selectedFaculties, faculty]);
        }
    }

    function handleRemoveFaculty(facultyToRemove) {
        setSelectedFaculties(selectedFaculties.filter((faculty) => faculty !== facultyToRemove));
    }

    function handleManualAdjustment(data, e) {
        e.preventDefault();
        const payloads = {
            selected_faculties: selectedFaculties?.map((faculty) => ({
                id: faculty.id,
                faculty_code: faculty.faculty_code,
            })),
            adjustment_reason: data.adjustmentReason,
            service_credits: data.serviceCredits,
            credit_action: creditAction,
        };
        console.log(payloads);
        router.post(route('admin.service-credits.store.adjust'), payloads,{
            onSuccess: ()=>{
                setSelectedFaculties([]);
                reset();
            }
        })
    }

    return (
        <div className="relative p-4 w-full  max-h-full">
            <div className="relative bg-white border border-gray-300 rounded-lg shadow ">
                <div className="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                    <h3 className="text-lg font-semibold text-gray-900 ">Manual Adjustment</h3>
                </div>
                <form className="p-4 md:p-5">
                    <div className="grid gap-4 mb-4">
                        <div>
                            <label className="block mb-2 text-sm font-medium text-gray-900 ">Faculty Name</label>

                            <FacultyAutoComplete
                                selected={null}
                                setSelected={handleSelection}
                            />
                        </div>
                        <div>
                            <label className="block mb-2 text-sm font-medium text-gray-900">Selected Faculties:</label>
                            <div>
                                {selectedFaculties?.map((faculty, index) => (
                                    <div
                                        key={index}
                                        className="flex justify-between items-center space-x-2 border border-gray-400 bg-gray-100 p-2 rounded-lg mb-2">
                                        <span>{`[${faculty?.faculty_code}] ${faculty?.personal_information?.first_name} ${faculty?.personal_information?.last_name}`}</span>
                                        <button
                                            type="button"
                                            className="text-red-700 hover:text-red-600 hover:scale-125 transition-all"
                                            onClick={() => handleRemoveFaculty(faculty)}>
                                            <FaTimesCircle />
                                        </button>
                                    </div>
                                ))}
                            </div>
                        </div>

                        <div>
                            <label className="block mb-2 text-sm font-medium text-gray-900 ">
                                Adjustment Reason
                                <textarea
                                    {...register("adjustmentReason")}
                                    type="text"
                                    placeholder="Adjustment Reason"
                                    className="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-100 text-base focus:ring-blue-500 focus:border-blue-500"
                                />
                            </label>
                        </div>

                        <div>
                            <div className="flex mb-1">
                                <div className="mr-5">
                                    <label className="block mb-2 text-sm font-medium text-gray-900 ">Credits:</label>
                                </div>

                                <div className="flex -mt-2">
                                    <div className="flex items-center me-4">
                                        <label className="ms-2 text-sm font-medium text-gray-900 ">
                                            <input
                                                type="checkbox"
                                                value="add"
                                                checked={creditAction === "add"}
                                                onChange={() => setCreditAction("add")}
                                                className="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                            />{" "}
                                            Add
                                        </label>
                                    </div>
                                    <div className="flex items-center me-4">
                                        <label className="ms-2 text-sm font-medium text-gray-900 ">
                                            <input
                                                type="checkbox"
                                                value="remove"
                                                checked={creditAction === "remove"}
                                                onChange={() => setCreditAction("remove")}
                                                className="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                            />{" "}
                                            Remove
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input
                                {...register("serviceCredits")}
                                type="number"
                                min="1"
                                className="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     "
                                required
                            />
                        </div>

                        <div className="mt-8 flex items-center justify-center">
                            <button
                                onClick={handleSubmit(handleManualAdjustment)}
                                className="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    );
}
