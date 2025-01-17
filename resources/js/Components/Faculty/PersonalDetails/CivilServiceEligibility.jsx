import { router } from "@inertiajs/react";
import { useState } from "react";
import { useForm } from "react-hook-form";
import { v7 as uuidv7 } from "uuid";

import { useFetchData } from "@/Hooks/useFetchData";
import { getDateToday } from "@/Utils/customDayjsUtils";

import CustomDatePicker from "@/Components/CustomDatePicker";

export function CivilServiceEligibility() {
    const { data: inputFields, setData: setInputFields } = useFetchData("/civil-service/all");
    const [inputEditable, setInputEditable] = useState(false);

    const {
        handleSubmit,
        formState: { errors },
    } = useForm();


    function onSave() {
        const payload = {
            civilServices: inputFields,
        };
        console.log(payload);
        router.patch(route("civil-service.update"), payload, {
            onSuccess: ()=>{
                setInputEditable(false);
            }
        });
    }

    function addRow() {
        setInputFields([
            ...inputFields,
            {
                publicId: uuidv7(),
                careerService: "",
                rating: "",
                dateOfExamination: "",
                placeOfExamination: "",
                licenseNumber: "",
                dateOfValidity: "",
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

    console.log(getDateToday());

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
                        Civil Service Eligibility
                        </h2>
                    </div>
                <div className={"space-x-4"}>
                    <button
                       onClick={() => {
                            setInputEditable((e) => !e);
                        }}
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
                                    rowSpan="2">
                                    CAREER SERVICE/ RA 1080 (BOARD/ BAR) UNDER
                                    SPECIAL LAWS/ CES/ CSEE BARANGAY ELIGIBILITY
                                    / DRIVER'S LICENSE
                                </th>
                                <th
                                    className="border px-4 py-2"
                                    rowSpan="2">
                                    RATING
                                    <br />
                                    (If Applicable)
                                </th>
                                <th
                                    className="border px-4 py-2"
                                    rowSpan="2">
                                    DATE OF EXAMINATION / CONFERMENT
                                </th>
                                <th
                                    className="border px-4 py-2"
                                    rowSpan="2">
                                    PLACE OF EXAMINATION / CONFERMENT
                                </th>
                                <th
                                    className="border px-4 py-2"
                                    colSpan="2">
                                    LICENSE (if applicable)
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
                                <th className="border px-4 py-2">NUMBER</th>
                                <th className="border px-4 py-2">
                                    Date of Validity
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {inputFields.map((field, index) => (
                                <tr key={field.publicId}>
                                    {/* Career Service */}
                                    <td className="border px-4 py-2">
                                        <input
                                            value={field.careerService}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "careerService",
                                                    e.target.value
                                                )
                                            }
                                            type="text"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Enter Career Service"
                                            disabled={!inputEditable}
                                        />
                                    </td>

                                    {/* Rating */}
                                    <td className="border px-4 py-2">
                                        <input
                                            value={field.rating}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "rating",
                                                    e.target.value
                                                )
                                            }
                                            type="text"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Enter Rating"
                                            disabled={!inputEditable}
                                        />
                                    </td>

                                    {/* Date of Examination */}
                                    <td className="border px-4 py-2">
                                        <CustomDatePicker
                                            value={{
                                                value: field.dateOfExamination
                                                    ? new Date(
                                                          field.dateOfExamination
                                                      )
                                                    : null,
                                                onChange: (value) =>
                                                    handleInputChange(
                                                        field.publicId,
                                                        "dateOfExamination",
                                                        value
                                                    ),
                                            }}
                                            name={`dateOfExamination-${index}`}
                                            disabled={!inputEditable}
                                            error={errors}
                                            minimumDate={"1970-01-01"}
                                            maximumDate={getDateToday()}
                                        />
                                    </td>

                                    {/* Place of Examination */}
                                    <td className="border px-4 py-2">
                                        <input
                                            value={field.placeOfExamination}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "placeOfExamination",
                                                    e.target.value
                                                )
                                            }
                                            type="text"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Enter Place of Examination"
                                            disabled={!inputEditable}
                                        />
                                    </td>

                                    {/* License Number */}
                                    <td className="border px-4 py-2">
                                        <input
                                            value={field.licenseNumber}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "licenseNumber",
                                                    e.target.value
                                                )
                                            }
                                            type="number"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder="Enter License Number"
                                            disabled={!inputEditable}
                                        />
                                    </td>

                                    {/* Date of Validity */}
                                    <td className="border px-4 py-2">
                                        <CustomDatePicker
                                            value={{
                                                value: field.dateOfValidity
                                                    ? new Date(
                                                          field.dateOfValidity
                                                      )
                                                    : null,
                                                onChange: (value) =>
                                                    handleInputChange(
                                                        field.publicId,
                                                        "dateOfValidity",
                                                        value
                                                    ),
                                            }}
                                            name={`dateOfValidity-${index}`}
                                            error={errors}
                                            minimumDate={"2000-01-01"}
                                            disabled={!inputEditable}
                                        />
                                    </td>

                                    {/* Action */}
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
                    {inputEditable && (<div className="mt-4 flex justify-end">
                        <button
                            type="submit"
                            className="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                            Save
                        </button>
                    </div>)}
                </div>
            </form>
        </div>
    );
}
