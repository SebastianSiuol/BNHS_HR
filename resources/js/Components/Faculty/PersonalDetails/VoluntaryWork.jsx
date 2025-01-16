import { router } from "@inertiajs/react";
import { useState } from "react";
import { useForm } from "react-hook-form";

import { useFetchData } from "@/Hooks/useFetchData";
import { getDateToday } from "@/Utils/customDayjsUtils";

import CustomDatePicker from "@/Components/CustomDatePicker";

export function VoluntaryWork() {
    const { data: inputFields, setData: setInputFields } = useFetchData("/voluntary-work/all");
    const [inputEditable, setInputEditable] = useState(false);

    const {
        handleSubmit,
        formState: { errors },
    } = useForm();

    function onSave() {
        const payload = { voluntaryWorks: inputFields };
        router.patch(route("voluntary-work.update"), payload, {
            onSuccess: () => {
                setInputEditable(false);
            },
        });
    }

    function addRow() {
        setInputFields([
            ...inputFields,
            {
                id: null,
                organizationName: "",
                dateFrom: "",
                dateTo: "",
                hours: "",
                position: "",
            },
        ]);
    }

    function deleteRow(id) {
        const updatedFields = inputFields.filter((field) => field.id !== id);
        setInputFields(updatedFields);
    }

    function handleInputChange(id, field, value) {
        const newFields = inputFields.map((input) =>
            input.id === id ? { ...input, [field]: value } : input
        );
        setInputFields(newFields);
    }

    return (
        <div className="bg-white shadow p-6 rounded-lg">
            <div className="flex justify-between items-center border-b pb-4 mb-4">
                <div>
                    {inputEditable && (
                        <h1 className="text-yellow-600 font-bold">
                            Now Editing
                        </h1>
                    )}
                    <h2 className="text-lg font-bold text-gray-800">
                        Voluntary Work
                    </h2>
                </div>
                <div className="space-x-4">
                    <button
                        onClick={() => setInputEditable(!inputEditable)}
                        className="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600"
                    >
                        Edit
                    </button>
                    {inputEditable && (
                        <button
                            onClick={addRow}
                            className="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600"
                        >
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
                                <th className="border px-4 py-2" rowSpan="2">
                                    NAME & ADDRESS OF ORGANIZATION <br />
                                    (Write in full)
                                </th>
                                <th className="border px-4 py-2" colSpan="2">
                                    INCLUSIVE DATES
                                </th>
                                <th className="border px-4 py-2" rowSpan="2">
                                    NUMBER OF HOURS
                                </th>
                                <th className="border px-4 py-2" rowSpan="2">
                                    POSITION / NATURE OF WORK
                                </th>
                                {inputEditable && (
                                    <th className="border px-4 py-2" rowSpan="2">
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
                                <tr key={field.id}>
                                    <td className="border px-4 py-2">
                                        <input
                                            type="text"
                                            value={field.organizationName}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.id,
                                                    "organizationName",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Organization Name"
                                            disabled={!inputEditable}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">

                                        <CustomDatePicker
                                            value={{
                                                value: field.dateFrom
                                                    ? new Date(field.dateFrom)
                                                    : null,
                                                onChange: (value) =>
                                                    handleInputChange(field.id, "dateFrom", value),
                                            }}
                                            name={`dateFrom-${index}`}
                                            disabled={!inputEditable}
                                            error={errors}
                                            minimumDate={'1970-01-01'}
                                            maximumDate={getDateToday()}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">

                                        <CustomDatePicker
                                            value={{
                                                value: field.dateTo
                                                    ? new Date(field.dateTo)
                                                    : null,
                                                onChange: (value) =>
                                                    handleInputChange(field.id, "dateTo", value),
                                            }}
                                            name={`dateTo-${index}`}
                                            disabled={!inputEditable}
                                            error={errors}
                                            minimumDate={'1970-01-01'}
                                            maximumDate={getDateToday()}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            type="number"
                                            value={field.hours}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.id,
                                                    "hours",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Hours"
                                            disabled={!inputEditable}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            type="text"
                                            value={field.position}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.id,
                                                    "position",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Position/Nature of Work"
                                            disabled={!inputEditable}
                                        />
                                    </td>
                                    {inputEditable && (
                                        <td className="border px-4 py-2 text-center">
                                            <button
                                                type="button"
                                                onClick={() =>
                                                    deleteRow(field.id)
                                                }
                                                className="text-red-500 hover:text-red-700"
                                            >
                                                ✕
                                            </button>
                                        </td>
                                    )}
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
                {inputEditable && (
                    <div className="mt-6 flex justify-end">
                        <button
                            type="submit"
                            className="bg-green-500 text-white px-6 py-2 rounded-lg shadow hover:bg-green-600"
                        >
                            Save
                        </button>
                    </div>
                )}
            </form>
        </div>
    );
};