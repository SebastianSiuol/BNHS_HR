import React from "react";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";

import { LabeledInput } from "@/Components/LabeledInput";
import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";

const FORM_DATA_KEY = "second_form_local_data";

const addressDataSchema = z.object({
    residential_house_num: z.string().min(1, { message: "Required" }),
    residential_street: z.string().min(1, { message: "Required" }),
    residential_subdivision: z.string().min(1, { message: "Required" }),
    residential_barangay: z.string().min(1, { message: "Required" }),
    residential_city: z.string().min(1, { message: "Required" }),
    residential_province: z.string().min(1, { message: "Required" }),
    residential_zip_code: z.string().min(1, { message: "Required" }),
    permanent_house_num: z.string().min(1, { message: "Required" }),
    permanent_street: z.string().min(1, { message: "Required" }),
    permanent_subdivision: z.string().min(1, { message: "Required" }),
    permanent_barangay: z.string().min(1, { message: "Required" }),
    permanent_city: z.string().min(1, { message: "Required" }),
    permanent_province: z.string().min(1, { message: "Required" }),
    permanent_zip_code: z.string().min(1, { message: "Required" }),
});

export function AddressForm({ prevStep, nextStep }) {
    const { nextForm } = useMultiStepForm();

    const {
        register,
        formState: { errors },
        handleSubmit,
        watch,
    } = useForm({
        resolver: zodResolver(addressDataSchema),
        defaultValues: getSavedData(),
    });

    // Initially gets Data
    function getSavedData() {
        let data = localStorage.getItem(FORM_DATA_KEY);
        if (data) {
            try {
                data = JSON.parse(data);
            } catch (err) {
                console.log(err);
            }
            return data;
        }
        return;
    }

    // Persistantly Uploads Form Data
    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    function onSecondFormSubmit(data) {
        nextForm(data);
        nextStep();
    }

    return (
        <>
            <form>
                <div className="grid grid-cols-none lg:grid-cols-2 gap-16">
                    <div>
                        <div>
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
                        <div>
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
                <div className={"flex justify-between"}>
                    <button
                        onClick={prevStep}
                        className={
                            "text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                        }
                    >
                        Back
                    </button>
                    <button
                        onClick={handleSubmit(onSecondFormSubmit)}
                        className={
                            "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        }
                    >
                        Next: Account Login
                    </button>
                </div>
            </form>
        </>
    );
}
