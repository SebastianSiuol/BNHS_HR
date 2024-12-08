import { useEffect } from "react";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";


import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";

import { NavButton } from "@/Components/MultiStepForm/NavButton";
import { LabeledInput } from "@/Components/LabeledInput";

import { addressDataSchema } from "@/Schemas/MultistepFormSchema";

const FORM_DATA_KEY = "second_form_local_data";

export function AddressForm() {
    const { getSavedData, prevStep, nextStep } = useMultiStepForm();

    const {
        register,
        formState: { errors },
        handleSubmit,
        watch,
        setValue,
    } = useForm({
        resolver: zodResolver(addressDataSchema),
        defaultValues: getSavedData(FORM_DATA_KEY),
    });

    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    function copyAddress(e) {
        e.preventDefault();

        const residentialFields = watch([
            "residential_house_num",
            "residential_street",
            "residential_subdivision",
            "residential_barangay",
            "residential_city",
            "residential_province",
            "residential_zip_code",
        ]);

        // Set permanent fields
        setValue("permanent_house_num", residentialFields[0]);
        setValue("permanent_street", residentialFields[1]);
        setValue("permanent_subdivision", residentialFields[2]);
        setValue("permanent_barangay", residentialFields[3]);
        setValue("permanent_city", residentialFields[4]);
        setValue("permanent_province", residentialFields[5]);
        setValue("permanent_zip_code", residentialFields[6]);
    }

    function onSecondFormSubmit(e) {
        e.preventDefault;
        nextStep();
    }

    return (
        <>
            <form>
                {/* Container */}

                <div className="relative grid grid-cols-none lg:grid-cols-2 gap-16">
                    <button
                        onClick={(e) => copyAddress(e)}
                        className={
                            "absolute right-2 -top-20 my-2 py-1 px-4 bg-blue-600 text-sm font-bold text-white border border-blue-600 rounded-3xl hover:bg-blue-800 hover:text-grey-600 hover:border-blue-800"
                        }
                    >
                        Copy Residential to Permanent
                    </button>

                    <div>
                        <div className="flex items-center">
                            <h6 className="font-semibold">
                                Residential Address
                            </h6>
                        </div>

                        {/* First Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabeledInput
                                id={"residential_house_num"}
                                register={register}
                                label={"House/Block/Lot No."}
                                placeholder={"House/Block/Lot No."}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />

                            <LabeledInput
                                id={"residential_street"}
                                register={register}
                                label={"Street"}
                                placeholder={"Street"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>

                        {/* Second Row! */}
                        <div>
                            <LabeledInput
                                id={"residential_subdivision"}
                                register={register}
                                label={"Subdivision/Village"}
                                placeholder={"Subdivision/Village"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>

                        {/* Third Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabeledInput
                                id={"residential_barangay"}
                                register={register}
                                label={"Barangay"}
                                placeholder={"Barangay"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                            <LabeledInput
                                id={"residential_city"}
                                register={register}
                                label={"City/Municipality"}
                                placeholder={"City/Municipality"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>

                        {/* Fourth Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabeledInput
                                id={"residential_province"}
                                register={register}
                                label={"Province"}
                                placeholder={"Province"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                            <LabeledInput
                                id={"residential_zip_code"}
                                register={register}
                                label={"Zip Code"}
                                placeholder={"Zip Code"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>
                    </div>

                    <div>
                        <div className={"flex items-center"}>
                            <h6 className="font-semibold">Permanent Address</h6>
                        </div>
                        {/* First Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabeledInput
                                id={"permanent_house_num"}
                                register={register}
                                label={"House/Block/Lot No."}
                                placeholder={"House/Block/Lot No."}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />

                            <LabeledInput
                                id={"permanent_street"}
                                register={register}
                                label={"Street"}
                                placeholder={"Street"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>

                        {/* Second Row! */}
                        <div>
                            <LabeledInput
                                id={"permanent_subdivision"}
                                register={register}
                                label={"Subdivision/Village"}
                                placeholder={"Subdivision/Village"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>

                        {/* Third Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabeledInput
                                id={"permanent_barangay"}
                                register={register}
                                label={"Barangay"}
                                placeholder={"Barangay"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                            <LabeledInput
                                id={"permanent_city"}
                                register={register}
                                label={"City/Municipality"}
                                placeholder={"City/Municipality"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>

                        {/* Fourth Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabeledInput
                                id={"permanent_province"}
                                register={register}
                                label={"Province"}
                                placeholder={"Province"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                            <LabeledInput
                                id={"permanent_zip_code"}
                                register={register}
                                label={"Zip Code"}
                                placeholder={"Zip Code"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>
                    </div>
                </div>
                <div className={"flex justify-between mt-8"}>
                    <NavButton type={"prev"} onClick={prevStep}>
                        Back
                    </NavButton>
                    <NavButton
                        type={"next"}
                        onClick={handleSubmit(onSecondFormSubmit)}
                    >
                        Next: Account
                    </NavButton>
                </div>
            </form>
        </>
    );
}
