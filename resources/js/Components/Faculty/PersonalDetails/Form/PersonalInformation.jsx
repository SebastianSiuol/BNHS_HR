import { useState, useEffect } from "react";
import { useForm, Controller } from "react-hook-form";
import { usePage, router } from "@inertiajs/react";
import { z } from "zod";
import dayjs from "dayjs";

import CustomDatePicker from "@/Components/CustomDatePicker";
import { LabelInput } from "@/Components/LabelInput";
import { InputSelect } from "@/Components/InputSelect";

export function PersonalInformation() {
    const { personalInfo } = usePage().props;
    const retrievedValues = {
        ...personalInfo.email,
        ...personalInfo.personal_information,
        ...personalInfo.addresses,
        ...personalInfo.phil_ids,
        ...personalInfo.medical_info,
    };
    const [inputEditable, setInputEditable] = useState(false);

    const {
        register,
        handleSubmit,
        formState: { errors },
        control,
    } = useForm({
        defaultValues: retrievedValues,
    });

    const eighteenYearsAgo = dayjs().subtract(18, "year");

    function onSave(data, e){
        const payload = {
            personal_information: {
                first_name: data.first_name,
                middle_name: data.middle_name,
                last_name: data.last_name,
                name_extension_id: data.name_extension_id,
                date_of_birth: data.date_of_birth,
                place_of_birth: data.place_of_birth,
                sex: data.sex,
                civil_status_id: data.civil_status_id,
            },
            addresses: {
                residential: {
                    house_num: data.residential_house_num,
                    street: data.residential_street,
                    subdivision: data.residential_subdivision,
                    barangay: data.residential_barangay,
                    city: data.residential_city,
                    province: data.residential_province,
                    zip_code: data.residential_zip_code,
                },
                permanent: {
                    house_num: data.permanent_house_num,
                    street: data.permanent_street,
                    subdivision: data.permanent_subdivision,
                    barangay: data.permanent_barangay,
                    city: data.permanent_city,
                    province: data.permanent_province,
                    zip_code: data.permanent_zip_code,
                },
            },
            phil_ids: {
                gsis_id_no: data.gsis_id_no,
                pag_ibig_id_no: data.pag_ibig_id_no,
                sss_no: data.sss_no,
                tin_no: data.tin_no,
                philhealth_no: data.philhealth_no,
            },
            medical_information: {
                height: data.height,
                weight: data.weight,
                blood_type: data.blood_type,
            },
            contact_information: {
                contact_number: data.contact_number,
                telephone_number: data.telephone_number,
                email: data.email,
            },
        };
        e.preventDefault();
        console.log(payload);
        router.patch(route('personal-information.edit.update'), payload, {
            onSuccess: ()=>{setInputEditable(false)}
        });
    }

    return (
        <div className=" bg-white shadow p-6 rounded-lg">
                <div className="flex justify-between items-center border-b pb-4 mb-4">
                    <div>
                        {inputEditable && (
                            <h1 className={"text-yellow-600 font-bold"}>
                                Now Editing
                            </h1>
                        )}
                        <h2 className="text-lg font-bold text-gray-800">
                            Personal Information
                        </h2>
                    </div>

                    <button
                        onClick={() => {
                            setInputEditable((e) => !e);
                        }}
                        className="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600">
                        Edit
                    </button>
                </div>
            <form>

                <div className="grid gap-4 mb-4 sm:grid-cols-4">
                    <LabelInput
                        id={"first_name"}
                        label={"First Name"}
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
                    <label
                        className={
                            "my-2 text-sm space-y-2 text-black font-normal"
                        }>
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
                    <label
                        className={
                            "my-2 text-sm space-y-2 text-black font-normal"
                        }>
                        <span>Date of Birth</span>
                        <Controller
                            control={control}
                            name={"date_of_birth"}
                            render={({ field }) => (
                                <CustomDatePicker
                                    value={field}
                                    error={errors}
                                    name={"date_of_birth"}
                                    disabled={!inputEditable}
                                    minimumDate={"1950-01-01"}
                                    maximumDate={eighteenYearsAgo.format(
                                        "YYYY-MM-DD"
                                    )}
                                />
                            )}
                        />
                    </label>
                    <LabelInput
                        id={"place_of_birth"}
                        label={"Place of Birth"}
                        register={register}
                        error={errors}
                        disabled={!inputEditable}
                    />
                    <label
                        className={
                            "my-2 text-sm space-y-2 text-black font-normal"
                        }>
                        <span>Sex</span>
                        <InputSelect
                            id={"sex"}
                            register={register}
                            defaultValues={"Male"}
                            disabled={!inputEditable}>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </InputSelect>
                    </label>
                    <label
                        className={
                            "my-2 text-sm space-y-2 text-black font-normal"
                        }>
                        <span>Civil Status</span>
                        <InputSelect
                            id={"civil_status_id"}
                            register={register}
                            disabled={!inputEditable}>
                            <option value="1">Single</option>
                            <option value="2">Married</option>
                            <option value="3">Widowed</option>
                            <option value="4">Separated</option>
                        </InputSelect>
                    </label>
                    <LabelInput
                        id={"height"}
                        label={"Height (cm)"}
                        register={register}
                        error={errors}
                        disabled={!inputEditable}
                    />
                    <LabelInput
                        id={"weight"}
                        label={"Weight (kg)"}
                        register={register}
                        error={errors}
                        disabled={!inputEditable}
                    />
                    <LabelInput
                        id={"blood_type"}
                        label={"Blood Type"}
                        register={register}
                        error={errors}
                        disabled={!inputEditable}
                    />
                    <LabelInput
                        id={"gsis_id_no"}
                        label={"GSIS ID No."}
                        register={register}
                        error={errors}
                        disabled={!inputEditable}
                    />
                    <LabelInput
                        id={"pag_ibig_id_no"}
                        label={"PAG-IBIG ID No."}
                        register={register}
                        error={errors}
                        disabled={!inputEditable}
                    />
                    <LabelInput
                        id={"sss_no"}
                        label={"SSS No."}
                        register={register}
                        error={errors}
                        disabled={!inputEditable}
                    />
                    <LabelInput
                        id={"tin_no"}
                        label={"TIN No."}
                        register={register}
                        error={errors}
                        disabled={!inputEditable}
                    />
                    <LabelInput
                        id={"philhealth_no"}
                        label={"Philheath No."}
                        register={register}
                        error={errors}
                        disabled={!inputEditable}
                    />
                    <LabelInput
                        id={"contact_number"}
                        label={"Contact Number"}
                        placeholder={"09XXXXXXXXX"}
                        register={register}
                        error={errors}
                        disabled={!inputEditable}
                    />
                    <LabelInput
                        id={"telephone_number"}
                        label={"Telephone Number"}
                        register={register}
                        error={errors}
                        disabled={!inputEditable}
                    />
                    <LabelInput
                        id={"email"}
                        label={"Email"}
                        placeholder={"*@email.com"}
                        register={register}
                        error={errors}
                        disabled={!inputEditable}
                    />
                </div>

                <div>
                    <div className="bg-blue-950 my-5 h-px w-full"></div>
                </div>
                <div className="relative grid grid-cols-none lg:grid-cols-2 gap-16">
                    <div>
                        <div className="flex items-center">
                            <h6 className="font-semibold">
                                Residential Address
                            </h6>
                        </div>

                        {/* First Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabelInput
                                id={"residential_house_num"}
                                label={"House/Block/Lot No."}
                                register={register}
                                error={errors}
                                disabled={!inputEditable}
                            />
                            <LabelInput
                                id={"residential_street"}
                                label={"Street"}
                                register={register}
                                error={errors}
                                disabled={!inputEditable}
                            />
                        </div>

                        {/* Second Row! */}
                        <div>
                            <LabelInput
                                id={"residential_subdivision"}
                                label={"Subdivision/Village"}
                                register={register}
                                error={errors}
                                disabled={!inputEditable}
                            />
                        </div>

                        {/* Third Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabelInput
                                id={"residential_barangay"}
                                label={"Barangay"}
                                register={register}
                                error={errors}
                                disabled={!inputEditable}
                            />
                            <LabelInput
                                id={"residential_city"}
                                label={"City/Municipality"}
                                register={register}
                                error={errors}
                                disabled={!inputEditable}
                            />
                        </div>

                        {/* Fourth Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabelInput
                                id={"residential_province"}
                                label={"Province"}
                                register={register}
                                error={errors}
                                disabled={!inputEditable}
                            />
                            <LabelInput
                                id={"residential_zip_code"}
                                label={"Zip Code"}
                                register={register}
                                error={errors}
                                disabled={!inputEditable}
                            />
                        </div>
                    </div>
                    <div>
                        <div className="flex items-center">
                            <h6 className="font-semibold">Permanent Address</h6>
                        </div>

                        {/* First Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabelInput
                                id={"permanent_house_num"}
                                label={"House/Block/Lot No."}
                                register={register}
                                error={errors}
                                disabled={!inputEditable}
                            />
                            <LabelInput
                                id={"permanent_street"}
                                label={"Street"}
                                register={register}
                                error={errors}
                                disabled={!inputEditable}
                            />
                        </div>

                        {/* Second Row! */}
                        <div>
                            <LabelInput
                                id={"permanent_subdivision"}
                                label={"Subdivision/Village"}
                                register={register}
                                error={errors}
                                disabled={!inputEditable}
                            />
                        </div>

                        {/* Third Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabelInput
                                id={"permanent_barangay"}
                                label={"Barangay"}
                                register={register}
                                error={errors}
                                disabled={!inputEditable}
                            />
                            <LabelInput
                                id={"permanent_city"}
                                label={"City/Municipality"}
                                register={register}
                                error={errors}
                                disabled={!inputEditable}
                            />
                        </div>

                        {/* Fourth Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabelInput
                                id={"permanent_province"}
                                label={"Province"}
                                register={register}
                                error={errors}
                                disabled={!inputEditable}
                            />
                            <LabelInput
                                id={"permanent_zip_code"}
                                label={"Zip Code"}
                                register={register}
                                error={errors}
                                disabled={!inputEditable}
                            />
                        </div>
                        {inputEditable && (
                            <div className="mt-4 flex justify-end">
                                <button
                                    onClick={handleSubmit(onSave)}
                                    className="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                    Save
                                </button>
                            </div>
                        )}
                    </div>
                </div>
            </form>
        </div>
    );
}
