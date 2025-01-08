import { useState, useEffect } from "react";
import { useForm, Controller } from "react-hook-form";
import { usePage, router } from "@inertiajs/react";
import { z } from "zod";

import CustomDatePicker from "@/Components/CustomDatePicker";
import { LabelInput } from "@/Components/LabelInput";
import { InputSelect } from "@/Components/InputSelect";

export function LearningAndDevelopment() {
    const [inputFields, setInputFields] = useState([]);
    const [inputEditable, setInputEditable] = useState(false);

    const { handleSubmit, formState: { errors } } = useForm();

    useEffect(() => {
        async function fetchData() {
            const response = await fetch("/learning-and-development/all", {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            });
            const parsedResponse = await response.json();
            setInputFields(parsedResponse);
        }

        fetchData();
    }, []);

    function onSave() {
        const payload = { learningAndDevelopment: inputFields };
        console.log(payload);
        // Example PATCH request
        router.patch(route("learning-and-development.update"), payload);
    }

    function addRow() {
        setInputFields([
            ...inputFields,
            {
                id: null,
                title: "",
                dateFrom: "",
                dateTo: "",
                hours: "",
                type: "",
                conductedBy: "",
            },
        ]);
    }

    function deleteRow(id) {
        const updatedFields = inputFields.filter((field) => field.id !== id);
        setInputFields(updatedFields);
    }

    function handleInputChange(id, field, value) {
        const updatedFields = inputFields.map((fieldItem) =>
            fieldItem.id === id ? { ...fieldItem, [field]: value } : fieldItem
        );
        setInputFields(updatedFields);
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
                        Learning and Development
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
                                    TITLE OF LEARNING AND DEVELOPMENT
                                    INTERVENTIONS/TRAINING PROGRAMS <br />
                                    (Write in full)
                                </th>
                                <th className="border px-4 py-2" colSpan="2">
                                    INCLUSIVE DATES OF ATTENDANCE
                                </th>
                                <th className="border px-4 py-2" rowSpan="2">
                                    NUMBER OF HOURS
                                </th>
                                <th className="border px-4 py-2" rowSpan="2">
                                    Type of LD (Managerial/ Supervisory/
                                    Technical/etc)
                                </th>
                                <th className="border px-4 py-2" rowSpan="2">
                                    CONDUCTED/ SPONSORED BY <br />
                                    (Write in full)
                                </th>
                                {inputEditable && (
                                    <th
                                        className="border px-4 py-2"
                                        rowSpan="2"
                                    >
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
                                            value={field.title}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.id,
                                                    "title",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Title"
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
                                            minimumDate={"2000-01-01"}
                                            disabled={!inputEditable}
                                            error={errors}
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
                                            minimumDate={"2000-01-01"}
                                            disabled={!inputEditable}
                                            error={errors}
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
                                            value={field.type}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.id,
                                                    "type",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Type"
                                            disabled={!inputEditable}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            type="text"
                                            value={field.conductedBy}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.id,
                                                    "conductedBy",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Conducted By"
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
}
