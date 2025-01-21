import { router } from "@inertiajs/react";
import { useState } from "react";
import { useForm } from "react-hook-form";
import { v7 as uuidv7 } from "uuid";

import { useFetchData } from "@/Hooks/useFetchData";
import { getDateToday } from "@/Utils/customDayjsUtils";

import CustomDatePicker from "@/Components/CustomDatePicker";
import { EditSectionHeader } from "@/Components/Faculty/PersonalDetails/EditSectionHeader";

export function LearningAndDevelopment() {
    const { data: inputFields, setData: setInputFields } = useFetchData(
        "/learning-and-development/all"
    );
    const [isInputEditable, setIsInputEditable] = useState(false);

    const {
        handleSubmit,
        formState: { errors },
    } = useForm();

    function onSave() {
        const payload = { learningAndDevelopment: inputFields };
        router.patch(route("learning-and-development.update"), payload, {
            onSuccess: () => {
                setIsInputEditable(false);
            },
        });
    }

    function addRow() {
        setInputFields([
            ...inputFields,
            {
                publicId: uuidv7(),
                title: "",
                dateFrom: "",
                dateTo: "",
                hours: "",
                type: "",
                conductedBy: "",
            },
        ]);
    }

    function deleteRow(publicId) {
        const updatedFields = inputFields.filter(
            (field) => field.publicId !== publicId
        );
        setInputFields(updatedFields);
    }

    function handleInputChange(publicId, field, value) {
        const updatedFields = inputFields.map((fieldItem) =>
            fieldItem.publicId === publicId
                ? { ...fieldItem, [field]: value }
                : fieldItem
        );
        setInputFields(updatedFields);
    }

    return (
        <div className="bg-white shadow p-6 rounded-lg">
            <EditSectionHeader
                header={"Learning and Development"}
                isInputEditable={isInputEditable}
                setIsInputEditable={setIsInputEditable}
                addButton={true}
                onAdd={addRow}
            />

            <form onSubmit={handleSubmit(onSave)}>
                <div className="container overflow-x-auto mx-auto">
                    <table className="min-w-full border-collapse border border-gray-300 text-sm text-left">
                        <thead className="bg-gray-50 text-center">
                            <tr>
                                <th
                                    className="border px-4 py-2"
                                    rowSpan="2">
                                    TITLE OF LEARNING AND DEVELOPMENT
                                    INTERVENTIONS/TRAINING PROGRAMS <br />
                                    (Write in full)
                                </th>
                                <th
                                    className="border px-4 py-2"
                                    colSpan="2">
                                    INCLUSIVE DATES OF ATTENDANCE
                                </th>
                                <th
                                    className="border px-4 py-2"
                                    rowSpan="2">
                                    NUMBER OF HOURS
                                </th>
                                <th
                                    className="border px-4 py-2"
                                    rowSpan="2">
                                    Type of LD (Managerial/ Supervisory/
                                    Technical/etc)
                                </th>
                                <th
                                    className="border px-4 py-2"
                                    rowSpan="2">
                                    CONDUCTED/ SPONSORED BY <br />
                                    (Write in full)
                                </th>
                                {isInputEditable && (
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
                                <tr key={field.publicId}>
                                    <td className="border px-4 py-2">
                                        <input
                                            type="text"
                                            value={field.title}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "title",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Title"
                                            disabled={!isInputEditable}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <CustomDatePicker
                                            value={{
                                                value: field.dateFrom
                                                    ? new Date(field.dateFrom)
                                                    : null,
                                                onChange: (value) =>
                                                    handleInputChange(
                                                        field.publicId,
                                                        "dateFrom",
                                                        value
                                                    ),
                                            }}
                                            name={`dateFrom-${index}`}
                                            disabled={!isInputEditable}
                                            error={errors}
                                            minimumDate={"1970-01-01"}
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
                                                    handleInputChange(
                                                        field.publicId,
                                                        "dateTo",
                                                        value
                                                    ),
                                            }}
                                            name={`dateTo-${index}`}
                                            disabled={!isInputEditable}
                                            error={errors}
                                            minimumDate={"1970-01-01"}
                                            maximumDate={getDateToday()}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            type="number"
                                            value={field.hours}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "hours",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Hours"
                                            disabled={!isInputEditable}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            type="text"
                                            value={field.type}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "type",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Type"
                                            disabled={!isInputEditable}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            type="text"
                                            value={field.conductedBy}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "conductedBy",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Conducted By"
                                            disabled={!isInputEditable}
                                        />
                                    </td>
                                    {isInputEditable && (
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
                </div>
                {isInputEditable && (
                    <div className="mt-6 flex justify-end">
                        <button
                            type="submit"
                            className="bg-green-500 text-white px-6 py-2 rounded-lg shadow hover:bg-green-600">
                            Save
                        </button>
                    </div>
                )}
            </form>
        </div>
    );
}
