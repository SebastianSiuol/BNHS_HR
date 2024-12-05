import React from "react";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";

import { NavButton } from "@/Pages/Admin/Faculty/Create"
import { LabeledInput } from "@/Components/LabeledInput";
import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";

const FORM_DATA_KEY = "fifth_form_local_data";

const documentsDataSchema = z.object({
    resume_file: z.string().min(4, { message: "Required" }),
    joining_letter: z.string(),
    dropbox_url: z.string(),
    offer_letter: z.string(),
    csc_form_212: z.string(),
    gdrive_url: z.string(),
});

export function DocumentForm() {
    const { prevStep, getSavedData, postData } = useMultiStepForm();


    const {
        register,
        formState: { errors },
        handleSubmit,
        watch,
    } = useForm({
        resolver: zodResolver(documentsDataSchema),
        defaultValues: getSavedData(FORM_DATA_KEY),
    });

    // Persistantly Uploads Form Data
    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    function onFinalSubmit(e) {
        e.preventDefault;
        postData();
    }
    return (
        <>
            <div className="grid grid-cols-none lg:grid-cols-2 gap-16">
                <div>

                    <LabeledInput
                        id={"resume_file"}
                        register={register}
                        label={"Resume File"}
                        placeholder={"Resume File"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />
                    <LabeledInput
                        id={"joining_letter"}
                        register={register}
                        label={"Joining Letter"}
                        placeholder={"Joining Letter"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />
                    <LabeledInput
                        id={"dropbox_url"}
                        register={register}
                        label={"Dropbox URL"}
                        placeholder={"Dropbox URL"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />
                </div>
                <div>
                    <LabeledInput
                        id={"offer_letter"}
                        register={register}
                        label={"Offer Letter"}
                        placeholder={"Offer Letter"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />
                    <LabeledInput
                        id={"csc_form_212"}
                        register={register}
                        label={"CSC Form 212"}
                        placeholder={"CSC Form 212"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />
                    <LabeledInput
                        id={"gdrive_url"}
                        register={register}
                        label={"Google Drive URL"}
                        placeholder={"Google Drive URL"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />

                </div>
            </div>
            <div className={"flex justify-between mt-16"}>
            <NavButton type={'prev'} onClick={prevStep}>
                    Back
                </NavButton>
                <NavButton type={'submit'} onClick={handleSubmit(onFinalSubmit)}>
                    Submit
                </NavButton>

            </div>
        </>
    );
}
