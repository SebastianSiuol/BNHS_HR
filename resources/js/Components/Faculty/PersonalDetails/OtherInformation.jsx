import { useState, useEffect } from "react";
import { useForm, Controller } from "react-hook-form";
import { usePage, router } from "@inertiajs/react";
import { z } from "zod";

import CustomDatePicker from "@/Components/CustomDatePicker";
import { LabelInput } from "@/Components/LabelInput";
import { InputSelect } from "@/Components/InputSelect";

export function OtherInformation() {
    const [inputFields, setInputFields] = useState([]);
    const [inputEditable, setInputEditable] = useState(false);

    const {
        handleSubmit,
    } = useForm();

    useEffect(() => {
        async function fetchData() {
            const response = await fetch("/other-information/all", {
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
        const payload = { otherInformation: inputFields };
        console.log(payload);
        router.patch(route("other-information.update"), payload);
    }

    function addRow() {
        setInputFields([
            ...inputFields,
            {
                id: null,
                specialSkills: "",
                distinctions: "",
                memberships: "",
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
                        Other Information
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
                                <th className="border px-4 py-2">
                                    SPECIAL SKILLS and HOBBIES
                                </th>
                                <th className="border px-4 py-2">
                                    NON-ACADEMIC DISTINCTIONS / RECOGNITION <br />
                                    (Write in full)
                                </th>
                                <th className="border px-4 py-2">
                                    MEMBERSHIP IN ASSOCIATION/ORGANIZATION <br />
                                    (Write in full)
                                </th>
                                {inputEditable && (
                                    <th className="border px-4 py-2">
                                        Action
                                    </th>
                                )}
                            </tr>
                        </thead>
                        <tbody>
                            {inputFields.map((field) => (
                                <tr key={field.id}>
                                    <td className="border px-4 py-2">
                                        <input
                                            type="text"
                                            value={field.specialSkills}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.id,
                                                    "specialSkills",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Special Skills and Hobbies"
                                            disabled={!inputEditable}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            type="text"
                                            value={field.distinctions}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.id,
                                                    "distinctions",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Distinctions/Recognition"
                                            disabled={!inputEditable}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            type="text"
                                            value={field.memberships}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.id,
                                                    "memberships",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Memberships"
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
