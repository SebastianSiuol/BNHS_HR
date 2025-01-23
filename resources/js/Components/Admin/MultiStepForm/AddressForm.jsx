import { useEffect } from "react";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";


import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";

import { NavButton } from "@/Components/MultiStepForm/NavButton";

import { AddressFields } from '@/Components/AddressFields';


import { addressDataSchema } from "@/Schemas/MultistepFormSchema";

const FORM_DATA_KEY = "second_form_local_data";

export function AddressForm() {
    const { getSavedData, prevStep, nextStep } = useMultiStepForm();

    const savedData = getSavedData(FORM_DATA_KEY);

    const {
        register,
        formState: { errors },
        handleSubmit,
        watch,
        setValue,
    } = useForm({
        resolver: zodResolver(addressDataSchema),
        defaultValues: savedData,
    });

    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    function onSecondFormSubmit(e) {
        e.preventDefault;
        nextStep();
    }

    return (
        <>
            <form>
                <div className="relative grid grid-cols-none lg:grid-cols-2 gap-16">

                    <label className={"absolute right-2 -top-20 my-2 py-1 px-4 text-sm font-bold"}>
                        <input type={"checkbox"} {...register('sameAddress')}/>
                        <span>Same as Residential</span>
                    </label>

                    <AddressFields
                        title={"Residential Address"}
                        prefix="residential"
                        register={register}
                        watch={watch}
                        setValue={setValue}
                        errors={errors}
                    />

                    <AddressFields
                        title={"Permanent Address"}
                        prefix="permanent"
                        register={register}
                        watch={watch}
                        setValue={setValue}
                        errors={errors}
                        disabled={watch('sameAddress')}
                    />
                </div>
                <div className={"flex justify-between mt-8"}>
                    <NavButton type={"prev"} onClick={prevStep}>
                        Back
                    </NavButton>
                    <NavButton type={"next"} onClick={handleSubmit(onSecondFormSubmit)}>
                        Next: Account
                    </NavButton>
                </div>
            </form>
        </>
    );
}