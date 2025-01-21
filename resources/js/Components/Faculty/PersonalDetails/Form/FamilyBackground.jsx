import { Head, router } from "@inertiajs/react";
import { useState, useEffect } from "react";
import { useForm } from "react-hook-form";

import { v7 as uuidv7 } from "uuid";
import { getDateToday } from "@/Utils/customDayjsUtils";

import CustomDatePicker from "@/Components/CustomDatePicker";
import { LabelInput } from "@/Components/LabelInput";
import { InputSelect } from "@/Components/InputSelect";
import { EditSectionHeader } from "@/Components/Faculty/PersonalDetails/EditSectionHeader";

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
    const [isInputEditable, setIsInputEditable] = useState(false);
    const [spouseId, setSpouseId] = useState(null);

    const {
        register,
        handleSubmit,
        setValue,
        formState: { errors },
    } = useForm();

    useEffect(() => {
        async function fetchSpouseData() {
            try {
                const response = await fetch(route("spouse-member.get"), {
                    method: "GET",
                    headers: { "Content-Type": "application/json" },
                });

                if (!response.ok) {
                    console.error("An error has occured");
                }

                const parsedData = await response.json();

                setSpouseId(parsedData.publicId || null);

                setValue("first_name", parsedData.firstName || "");
                setValue("middle_name", parsedData.middleName || "");
                setValue("last_name", parsedData.lastName || "");
                setValue("name_extension_id", parsedData.nameExtensionId || 1);
                setValue("occupation", parsedData.occupation || "");
                setValue(
                    "employer_business_name",
                    parsedData.employerBusinessName || ""
                );
                setValue("business_address", parsedData.businessAddress || "");
                setValue("telephone_number", parsedData.telephoneNumber || "");
            } catch (error) {
                console.error(error);
            }
        }
        fetchSpouseData();
    }, []);

    function spouseSubmit(data, e) {
        e.preventDefault();
        const payload = {
            ...data,
            publicId: spouseId,
        };
        router.patch(route("spouse-member.update"), payload, {
            onSuccess: () => {
                setIsInputEditable(false);
            },
        });
    }

    return (
        <>
            <EditSectionHeader
                header={"Spouse"}
                isInputEditable={isInputEditable}
                setIsInputEditable={setIsInputEditable}
            />

            <form className="grid gap-4 mb-4 sm:grid-cols-4">
                <LabelInput
                    id={"first_name"}
                    label={"Spouse' First Name"}
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={"middle_name"}
                    label={"Middle Name (Optional)"}
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={"last_name"}
                    label={"Last Name"}
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <label className="my-2 text-sm space-y-2 text-black font-normal">
                    <span>Name Extension</span>
                    <InputSelect
                        id={"name_extension_id"}
                        register={register}
                        error={errors}
                        disabled={!isInputEditable}>
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
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={"employer_business_name"}
                    label={"Employer/Business Name"}
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={"business_address"}
                    label={"Business Address"}
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={"telephone_number"}
                    label={"Telephone No."}
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
            </form>
            {isInputEditable && (
                <div className="flex justify-end mb-12">
                    <button
                        onClick={handleSubmit(spouseSubmit)}
                        className="bg-green-500 text-white px-6 py-2 rounded-lg shadow hover:bg-green-600">
                        Save
                    </button>
                </div>
            )}
        </>
    );
}

function ParentMembers() {
    const [isInputEditable, setIsInputEditable] = useState(false);
    const [fatherId, setFatherId] = useState(null);
    const [motherId, setMotherId] = useState(null);

    const {
        register,
        handleSubmit,
        setValue,
        formState: { errors },
    } = useForm();

    useEffect(() => {
        async function fetchParentData() {
            try {
                const response = await fetch(route("parent-member.get"), {
                    method: "GET",
                    headers: { "Content-Type": "application/json" },
                });

                if (!response.ok) {
                    console.error("An error has occured");
                }

                const parsedData = await response.json();

                setFatherId(parsedData.father.publicId || null);
                setMotherId(parsedData.mother.publicId || null);

                setValue("father_first_name", parsedData.father.firstName || "");
                setValue("father_middle_name", parsedData.father.middleName || "");
                setValue("father_last_name", parsedData.father.lastName || "");
                setValue("father_name_extension_id", parsedData.father.nameExtensionId || 1);
                setValue("mother_maiden_name", parsedData.mother.maidenName || "");
                setValue("mother_first_name", parsedData.mother.firstName || "");
                setValue("mother_middle_name", parsedData.mother.middleName || "");
                setValue("mother_last_name", parsedData.mother.lastName || "");

            } catch (error) {
                console.error(error);
            }
        }
        fetchParentData();
    }, []);

    function parentSubmit(data, e) {
        e.preventDefault();
        const payload = {
            ...data, 'father_public_id' : fatherId, 'mother_public_id': motherId
        };
        router.patch(route("parent-member.update"), payload, {
            onSuccess: () => {
                setIsInputEditable(false);
            },
        });
    }
    return (
        <>
            <EditSectionHeader
                header={"Parent Members"}
                isInputEditable={isInputEditable}
                setIsInputEditable={setIsInputEditable}
            />
            <form>
                <div className="grid gap-4 mb-4 sm:grid-cols-4">
                    <LabelInput
                        id={"father_first_name"}
                        label={"Father's First Name"}
                        register={register}
                        error={errors}
                        disabled={!isInputEditable}
                    />
                    <LabelInput
                        id={"father_middle_name"}
                        label={"Middle Name (Optional)"}
                        register={register}
                        error={errors}
                        disabled={!isInputEditable}
                    />
                    <LabelInput
                        id={"father_last_name"}
                        label={"Last Name"}
                        register={register}
                        error={errors}
                        disabled={!isInputEditable}
                    />
                    <label className="my-2 text-sm space-y-2 text-black font-normal">
                        <span>Name Extension</span>
                        <InputSelect
                            id={"father_name_extension_id"}
                            register={register}
                            error={errors}
                            disabled={!isInputEditable}>
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
                        disabled={!isInputEditable}
                    />
                    <LabelInput
                        id={"mother_middle_name"}
                        label={"Middle Name (Optional)"}
                        register={register}
                        error={errors}
                        disabled={!isInputEditable}
                    />
                    <LabelInput
                        id={"mother_last_name"}
                        label={"Last Name"}
                        register={register}
                        error={errors}
                        disabled={!isInputEditable}
                    />
                    <LabelInput
                        id={"mother_maiden_name"}
                        label={"Mother's Maiden Name"}
                        register={register}
                        error={errors}
                        disabled={!isInputEditable}
                    />
                </div>
            </form>
            {isInputEditable && (
                <div className="flex justify-end mb-12">
                    <button
                        onClick={handleSubmit(parentSubmit)}
                        className="bg-green-500 text-white px-6 py-2 rounded-lg shadow hover:bg-green-600">
                        Save
                    </button>
                </div>
            )}
        </>
    );
}

function ChildrenMembers() {
    const { data: inputFields, setData: setInputFields } = useFetchData(route('child-member.get'));
    const [isInputEditable, setIsInputEditable] = useState(false);

    const {
        handleSubmit,
        formState: { errors },
    } = useForm();

    function addRow() {
        setInputFields([
            ...inputFields,
            {
                publicId: uuidv7(),
                nameOfChild: "",
                dateOfBirth: "",
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

    function onSave() {
        const payload = { childrenMembers: inputFields };
        router.patch(route("child-member.update"), payload, {
            onSuccess: () => {
                setIsInputEditable(false);
            },
        });
    }

    return (
        <>
            <EditSectionHeader
                header={"Children Members"}
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
                                    NAME of CHILDREN <br />( Write in full)
                                </th>
                                <th className="border px-4 py-2">
                                    Date of Birth
                                </th>

                                {isInputEditable && (
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
                                            value={field.nameOfChild}
                                            onChange={(e) =>
                                                handleInputChange(
                                                    field.publicId,
                                                    "nameOfChild",
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
                                            disabled={!isInputEditable}
                                            error={errors}
                                            minimumDate={"1970-01-01"}
                                            maximumDate={getDateToday()}
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
        </>
    );
}
