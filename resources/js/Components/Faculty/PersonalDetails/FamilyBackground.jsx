import { Head, router } from "@inertiajs/react";
import { useState } from "react";
import { useForm, Controller } from "react-hook-form";

import { v7 as uuidv7 } from "uuid";
import { getDateToday } from "@/Utils/customDayjsUtils";

import CustomDatePicker from "@/Components/CustomDatePicker";
import { LabelInput } from "@/Components/LabelInput";
import { InputSelect } from "@/Components/InputSelect";

import { useFetchData } from "@/Hooks/useFetchData";

export function FamilyBackground() {
    return (
        <>
            <Head title="Family Background" />

            <div className="bg-white shadow p-6 rounded-lg">
                <div className="flex justify-between items-center border-b pb-4 mb-4">
                    <div>
                        <h2 className="text-lg font-bold text-gray-800">
                            Family Background
                        </h2>
                    </div>
                </div>
                <Spouse />
                <ParentMembers />
                <ChildrenMembers />
            </div>
        </>
    );
}

function Spouse() {
    const [inputEditable, setInputEditable] = useState(false);

    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm();

    function spouseSubmit(data, e){
        e.preventDefault();
        router.patch(route('spouse-member.update'), data, {
            onSuccess: ()=>{
                setInputEditable(false);
            }
        })
    }

    return (
        <>
            <div className="flex justify-between items-center pb-4 mb-4">
                <div>
                    {inputEditable && (
                        <h1 className="text-yellow-600 font-bold">
                            Now Editing
                        </h1>
                    )}
                    <h2 className="text-lg font-bold text-gray-800">Spouse</h2>
                </div>
                <div className="space-x-4">
                    <button
                        onClick={() => {
                            setInputEditable((e) => !e);
                        }}
                        className="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600">
                        {inputEditable ? "Cancel Edit" : "Edit"}
                    </button>

                    {inputEditable && (
                        <button
                            onClick={handleSubmit(spouseSubmit)}
                            type="submit"
                            className="bg-green-500 text-white px-6 py-2 rounded-lg shadow hover:bg-green-600">
                            Save
                        </button>
                    )}
                </div>
            </div>

            <form className="grid gap-4 mb-4 sm:grid-cols-4">
                <LabelInput
                    id={"first_name"}
                    label={"Spouse' First Name"}
                    register={register}
                    error={errors}
                    disabled={!inputEditable}
                />
                <LabelInput
                    id={"middle_name"}
                    label={"Middle Name (Optional)"}
                    register={register}
                    error={errors}
                    disabled={!inputEditable}
                />
                <LabelInput
                    id={"last_name"}
                    label={"Last Name"}
                    register={register}
                    error={errors}
                    disabled={!inputEditable}
                />
                <label className="my-2 text-sm space-y-2 text-black font-normal">
                    <span>Name Extension</span>
                    <InputSelect
                        id={"name_extension_id"}
                        register={register}
                        error={errors}
                        disabled={!inputEditable}>
                        <option value="1">None</option>
                        <option value="2">Sr. </option>
                        <option value="3">Jr. </option>
                        <option value="4">I</option>
                        <option value="5">II</option>
                        <option value="6">III</option>
                        <option value="7">IV</option>
                        <option value="8">V</option>
                    </InputSelect>
                </label>
                <LabelInput
                    id={"occupation"}
                    label={"Occupation"}
                    register={register}
                    error={errors}
                    disabled={!inputEditable}
                />
                <LabelInput
                    id={"employer_business_name"}
                    label={"Employer/Business Name"}
                    register={register}
                    error={errors}
                    disabled={!inputEditable}
                />
                <LabelInput
                    id={"business_address"}
                    label={"Business Address"}
                    register={register}
                    error={errors}
                    disabled={!inputEditable}
                />
                <LabelInput
                    id={"telephone_number"}
                    label={"Telephone No."}
                    register={register}
                    error={errors}
                    disabled={!inputEditable}
                />
            </form>
        </>
    );
}

function ParentMembers() {
    const [inputEditable, setInputEditable] = useState(false);

    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm();

    return (
        <>
            <div className="flex justify-between items-center pb-4 mb-4">
                <div>
                    {inputEditable && (
                        <h1 className="text-yellow-600 font-bold">
                            Now Editing
                        </h1>
                    )}
                    <h2 className="text-lg font-bold text-gray-800">
                        Parent Members
                    </h2>
                </div>

                <button
                    onClick={() => {
                        setInputEditable((e) => !e);
                    }}
                    className="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600">
                    {inputEditable ? "Cancel Edit" : "Edit"}
                </button>
            </div>

            <div className="grid gap-4 mb-4 sm:grid-cols-4">
                <LabelInput
                    id={"father_first_name"}
                    label={"Father's First Name"}
                    register={register}
                    error={errors}
                    disabled={!inputEditable}
                />
                <LabelInput
                    id={"father_middle_name"}
                    label={"Middle Name (Optional)"}
                    register={register}
                    error={errors}
                    disabled={!inputEditable}
                />
                <LabelInput
                    id={"father_last_name"}
                    label={"Last Name"}
                    register={register}
                    error={errors}
                    disabled={!inputEditable}
                />
                <label className="my-2 text-sm space-y-2 text-black font-normal">
                    <span>Name Extension</span>
                    <InputSelect
                        id={"father_name_extension_id"}
                        register={register}
                        error={errors}
                        disabled={!inputEditable}>
                        <option value="1">None</option>
                        <option value="2">Sr. </option>
                        <option value="3">Jr. </option>
                        <option value="4">I</option>
                        <option value="5">II</option>
                        <option value="6">III</option>
                        <option value="7">IV</option>
                        <option value="8">V</option>
                    </InputSelect>
                </label>
            </div>
            <div className="grid gap-4 mb-4 sm:grid-cols-4">
                <LabelInput
                    id={"mother_first_name"}
                    label={"Mother's First Name"}
                    register={register}
                    error={errors}
                    disabled={!inputEditable}
                />
                <LabelInput
                    id={"mother_middle_name"}
                    label={"Middle Name (Optional)"}
                    register={register}
                    error={errors}
                    disabled={!inputEditable}
                />
                <LabelInput
                    id={"mother_last_name"}
                    label={"Last Name"}
                    register={register}
                    error={errors}
                    disabled={!inputEditable}
                />
            </div>
        </>
    );
}

function ChildrenMembers() {
    const { data: inputFields, setData: setInputFields } = useFetchData(
        "/learning-and-development/all"
    );
    const [inputEditable, setInputEditable] = useState(false);

    const {
        handleSubmit,
        formState: { errors },
    } = useForm();

    function onSave() {
        const payload = { learningAndDevelopment: inputFields };
        router.patch(route("learning-and-development.update"), payload, {
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
        <>
            <div className="flex justify-between items-center pb-4 mb-4">
                <div>
                    {inputEditable && (
                        <h1 className="text-yellow-600 font-bold">
                            Now Editing
                        </h1>
                    )}
                    <h2 className="text-lg font-bold text-gray-800">
                        Children Members
                    </h2>
                </div>
                <div className="space-x-4">
                    <button
                        onClick={() => {
                            setInputEditable((e) => !e);
                        }}
                        className="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600">
                        {inputEditable ? "Cancel Edit" : "Edit"}
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
                                <th className="border px-4 py-2">
                                    NAME of CHILDREN <br />( Write in full)
                                </th>
                                <th className="border px-4 py-2">
                                    Date of Birth
                                </th>

                                {inputEditable && (
                                    <th
                                        className="border px-4 py-2"
                                        rowSpan="2">
                                        Action
                                    </th>
                                )}
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
                                                    "nameOfChild",
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
                                                value: field.dateOfBirth
                                                    ? new Date(
                                                          field.dateOfBirth
                                                      )
                                                    : null,
                                                onChange: (value) =>
                                                    handleInputChange(
                                                        field.publicId,
                                                        "dateOfBirth",
                                                        value
                                                    ),
                                            }}
                                            name={`dateOfBirth-${index}`}
                                            disabled={!inputEditable}
                                            error={errors}
                                            minimumDate={"1970-01-01"}
                                            maximumDate={getDateToday()}
                                        />
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
                </div>
                {inputEditable && (
                    <div className="mt-6 flex justify-end">
                        <button
                            type="submit"
                            className="bg-green-500 text-white px-6 py-2 rounded-lg shadow hover:bg-green-600">
                            Save
                        </button>
                    </div>
                )}
            </form>
        </>
    );
}
