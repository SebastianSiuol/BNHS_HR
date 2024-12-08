// Libraries and Dependencies
import React from "react";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";

// Components
import { NavButton } from "@/Components/MultiStepForm/NavButton";

import { LabeledInput } from "@/Components/LabeledInput";
import { useMultiStepForm } from "@/Context/MultiStepFormContext";


const documentsDataSchema = z.object({
    resume_file: z.any(),
    joining_letter: z.any(),
    offer_letter: z.any(),
    csc_form_212: z.any(),
    dropbox_url: z.string(),
    gdrive_url: z.string(),
});

export function DocumentForm() {
    const { prevStep, postFormDatatoServer } = useMultiStepForm();
    const { register, handleSubmit, formState: { errors } } = useForm({
        resolver: zodResolver(documentsDataSchema),
    });

    function onFinalSubmit(submittedData) {

        postFormDatatoServer(submittedData);
    }

    return (
        <>
            <div className="grid grid-cols-none lg:grid-cols-2 gap-16">
                <div>

                    <LabeledInput
                        id={"resume_file"}
                        register={register}
                        label={"Resume File"}
                        type={'file'}
                        placeholder={"Resume File"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />

                    <LabeledInput
                        id={"joining_letter"}
                        register={register}
                        label={"Joining Letter"}
                        type={'file'}
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
                        type={'file'}
                        placeholder={"Offer Letter"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />
                    <LabeledInput
                        id={"csc_form_212"}
                        register={register}
                        label={"CSC Form 212"}
                        type={'file'}
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
