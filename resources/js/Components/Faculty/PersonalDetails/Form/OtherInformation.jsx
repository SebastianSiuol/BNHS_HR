import { router } from "@inertiajs/react";
import { useState } from "react";
import { useForm } from "react-hook-form";
import { v7 as uuidv7 } from "uuid";

import { useFetchData } from "@/Hooks/useFetchData";
import { EditSectionHeader } from "@/Components/Faculty/PersonalDetails/EditSectionHeader";

export function OtherInformation() {
    const { data: inputFields, setData: setInputFields } = useFetchData(
        "/other-information/all"
    );
    const [isInputEditable, setIsInputEditable] = useState(false);

    const { handleSubmit } = useForm();

    function onSave() {
        const payload = { otherInformation: inputFields };
        router.patch(route("other-information.update"), payload, {
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
                specialSkills: "",
                distinctions: "",
                memberships: "",
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
                header={"Other Information"}
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
                                <th className="border px-4 py-2">
                                    SPECIAL SKILLS and HOBBIES
                                </th>
                                <th className="border px-4 py-2">
                                    NON-ACADEMIC DISTINCTIONS / RECOGNITION{" "}
                                    <br />
                                    (Write in full)
                                </th>
                                <th className="border px-4 py-2">
                                    MEMBERSHIP IN ASSOCIATION/ORGANIZATION{" "}
                                    <br />
                                    (Write in full)
                                </th>
                                {isInputEditable && (
                                    <th className="border px-4 py-2">Action</th>
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
                                                    field.publicId,
                                                    "specialSkills",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Special Skills and Hobbies"
                                            disabled={!isInputEditable}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            type="text"
                                            value={field.distinctions}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "distinctions",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Distinctions/Recognition"
                                            disabled={!isInputEditable}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            type="text"
                                            value={field.memberships}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "memberships",
                                                    e.target.value
                                                )
                                            }
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Memberships"
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
