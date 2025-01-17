import { router } from "@inertiajs/react";
import { useState } from "react";
import { useForm } from "react-hook-form";
import { v7 as uuidv7 } from "uuid";

import { useFetchData } from "@/Hooks/useFetchData";
import { getDateToday } from "@/Utils/customDayjsUtils";

import CustomDatePicker from "@/Components/CustomDatePicker";

export function WorkExperience() {
    const { data: inputFields, setData: setInputFields } = useFetchData(
        "/work-experience/all"
    );
    const [inputEditable, setInputEditable] = useState(false);

    const {
        handleSubmit,
        formState: { errors },
    } = useForm();

    function onSave() {
        const payload = {
            workExperiences: inputFields,
        };
        router.patch(route("work-experience.update"), payload, {
            onSuccess: () => {
                setInputEditable(false);
            },
        });
    }

    function addRow() {
        setInputFields([
            ...inputFields,
            {
                publicId: uuidv7(),
                fromDate: "",
                toDate: "",
                positionTitle: "",
                department: "",
                monthlySalary: "",
                salaryGrade: "",
                statusOfAppointment: "",
                govService: "",
            },
        ]);
    }

    function deleteRow(publicId) {
        const newFields = inputFields.filter((field) => field.publicId !== publicId);
        setInputFields(newFields);
    }

    function handleInputChange(publicId, field, value) {
        const newFields = inputFields.map((input) =>
            input.publicId === publicId ? { ...input, [field]: value } : input
        );
        setInputFields(newFields);
    }

    return (
        <div className="bg-white shadow p-6 rounded-lg">
            <div className="flex justify-between items-center border-b pb-4 mb-4">
                <div>
                    {inputEditable && (
                        <h1 className={"text-yellow-600 font-bold"}>
                            Now Editing
                        </h1>
                    )}
                    <h2 className="text-lg font-bold text-gray-800">
                        Work Experience
                    </h2>
                </div>
                <div className={"space-x-4"}>
                    <button
                        onClick={() => setInputEditable((e) => !e)}
                        className="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600">
                        Edit
                    </button>
                    {inputEditable && (
                        <button
                            onClick={addRow}
                            className="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600">
                            Add
                        </button>
                    )}
                </div>
            </div>
            <form onSubmit={handleSubmit(onSave)}>
                <div className="container overflow-x-auto mx-auto">
                    <table className="min-w-full border-collapse border border-gray-300 text-sm text-left">
                        <thead className="bg-gray-50 text-center">
                            <tr>
                                <th
                                    className="border px-4 py-2"
                                    colSpan="2">
                                    INCLUSIVE DATES
                                </th>
                                <th
                                    className="border px-4 py-2"
                                    rowSpan="2">
                                    POSITION TITLE
                                </th>
                                <th
                                    className="border px-4 py-2"
                                    rowSpan="2">
                                    DEPARTMENT / AGENCY
                                </th>
                                <th
                                    className="border px-4 py-2"
                                    rowSpan="2">
                                    MONTHLY SALARY
                                </th>
                                <th
                                    className="border px-4 py-2"
                                    rowSpan="2">
                                    SALARY GRADE
                                </th>
                                <th
                                    className="border px-4 py-2"
                                    rowSpan="2">
                                    STATUS OF APPOINTMENT
                                </th>
                                <th
                                    className="border px-4 py-2"
                                    rowSpan="2">
                                    GOV'T SERVICE
                                </th>
                                {inputEditable && (
                                    <th
                                        className="border px-4 py-2"
                                        rowSpan="2">
                                        Action
                                    </th>
                                )}
                            </tr>
                            <tr>
                                <th className="border px-4 py-2">From</th>
                                <th className="border px-4 py-2">To</th>
                            </tr>
                        </thead>
                        <tbody>
                            {inputFields.map((field, index) => (
                                <tr key={field.publicId || index}>
                                    <td className="border px-4 py-2">
                                        <CustomDatePicker
                                            value={{
                                                value: field.fromDate
                                                    ? new Date(field.fromDate)
                                                    : null,
                                                onChange: (value) =>
                                                    handleInputChange(
                                                        field.publicId,
                                                        "fromDate",
                                                        value
                                                    ),
                                            }}
                                            name={`fromDate-${index}`}
                                            disabled={!inputEditable}
                                            error={errors}
                                            minimumDate={"1970-01-01"}
                                            maximumDate={getDateToday()}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <CustomDatePicker
                                            value={{
                                                value: field.toDate
                                                    ? new Date(field.toDate)
                                                    : null,
                                                onChange: (value) =>
                                                    handleInputChange(
                                                        field.publicId,
                                                        "toDate",
                                                        value
                                                    ),
                                            }}
                                            name={`toDate-${index}`}
                                            disabled={!inputEditable}
                                            error={errors}
                                            minimumDate={"1970-01-01"}
                                            maximumDate={getDateToday()}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            value={field.positionTitle}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "positionTitle",
                                                    e.target.value
                                                )
                                            }
                                            type="text"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            disabled={!inputEditable}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            value={field.department}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "department",
                                                    e.target.value
                                                )
                                            }
                                            type="text"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            disabled={!inputEditable}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            value={field.monthlySalary}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "monthlySalary",
                                                    e.target.value
                                                )
                                            }
                                            type="number"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            disabled={!inputEditable}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            value={field.salaryGrade}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "salaryGrade",
                                                    e.target.value
                                                )
                                            }
                                            type="text"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            disabled={!inputEditable}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            value={field.statusOfAppointment}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "statusOfAppointment",
                                                    e.target.value
                                                )
                                            }
                                            type="text"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            disabled={!inputEditable}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <select
                                            value={field.govService}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "govService",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            disabled={!inputEditable}>
                                            <option
                                                value=""
                                                disabled>
                                                Select
                                            </option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </td>
                                    {inputEditable && (
                                        <td className="border px-4 py-2 text-center">
                                            <button
                                                type="button"
                                                onClick={() =>
                                                    deleteRow(field.publicId)
                                                }
                                                className="text-red-500 hover:text-red-700">
                                                ✕
                                            </button>
                                        </td>
                                    )}
                                </tr>
                            ))}
                        </tbody>
                    </table>
                    {inputEditable && (
                        <div className="mt-4 flex justify-end">
                            <button
                                type="submit"
                                className="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                Save
                            </button>
                        </div>
                    )}
                </div>
            </form>
        </div>
    );
}
