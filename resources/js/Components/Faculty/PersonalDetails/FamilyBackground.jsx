import { useState, useEffect } from "react";
import { useForm, Controller } from "react-hook-form";
import { usePage, router } from "@inertiajs/react";
import { z } from "zod";

import CustomDatePicker from "@/Components/CustomDatePicker";
import { LabelInput } from "@/Components/LabelInput";
import { InputSelect } from "@/Components/InputSelect";

export function FamilyBackground() {
    const [inputEditable, setInputEditable] = useState(false);

    const {
        register,
        handleSubmit,
        formState: { errors },
        reset,
        control,
    } = useForm();

    return (
        <div className=" bg-white shadow p-6 rounded-lg">
            <div className="flex justify-between items-center border-b pb-4 mb-4">
                <div>
                    {inputEditable && <h1 className={"text-yellow-600 font-bold"}>Now Editing</h1>}
                    <h2 className="text-lg font-bold text-gray-800">Family Background</h2>
                </div>

                <button
                    onClick={() => {
                        setInputEditable((e) => !e);
                    }}
                    className="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600"
                >
                    Edit
                </button>
            </div>
            <div className="grid gap-4 mb-4 sm:grid-cols-4">
                <LabelInput id={"spouse_first_name"} label={"Spouse' First Name"} register={register} error={errors} disabled={!inputEditable}/>
                <LabelInput id={"spouse_middle_name"} label={"Middle Name (Optional)"} register={register} error={errors} disabled={!inputEditable}/>
                <LabelInput id={"spouse_last_name"} label={"Last Name"} register={register} error={errors} disabled={!inputEditable}/>
                <label className={"my-2 text-sm space-y-2 text-black font-normal"}>
                    <span>Name Extension</span>
                    <InputSelect id={"spouse_name_extension_id"} register={register} error={errors} disabled={!inputEditable}>
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
            <div className="mb-2 grid gap-4 sm:grid-cols-4">
                <p className="sm:col-span-3 text-sm font-medium text-gray-900 dark:text-white"> Name of Children (Full Name and List All)</p>
                <p className="text-sm font-medium text-gray-900 dark:text-white"> Date of Birth</p>
            </div>

            <div className="grid gap-4 mb-4 sm:grid-cols-4">
                <div className="sm:col-span-3">
                    <input
                        type="text"
                        pattern="[A-Za-z\s]+"
                        className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Child's Full Name"
                        required=""
                        disabled={!inputEditable}/>
                </div>
                <div>
                    <Controller control={control} name={"date_of_birth"} render={({ field }) => <CustomDatePicker value={field} error={errors} name={"date_of_birth"} disabled={!inputEditable}/>} />
                </div>
            </div>

            <div className="grid gap-4 mb-4 sm:grid-cols-4">
                <LabelInput id={"father_first_name"} label={"Father's First Name"} register={register} error={errors} disabled={!inputEditable}/>
                <LabelInput id={"father_middle_name"} label={"Middle Name (Optional)"} register={register} error={errors} disabled={!inputEditable}/>
                <LabelInput id={"father_last_name"} label={"Last Name"} register={register} error={errors} disabled={!inputEditable}/>
                <label className={"my-2 text-sm space-y-2 text-black font-normal"}>
                    <span>Name Extension</span>
                    <InputSelect id={"father_name_extension_id"} register={register} error={errors} disabled={!inputEditable}>
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
                <LabelInput id={"mother_first_name"} label={"Mother's First Name"} register={register} error={errors} disabled={!inputEditable}/>
                <LabelInput id={"mother_middle_name"} label={"Middle Name (Optional)"} register={register} error={errors} disabled={!inputEditable}/>
                <LabelInput id={"mother_last_name"} label={"Last Name"} register={register} error={errors} disabled={!inputEditable}/>
            </div>
        </div>
    );
}
