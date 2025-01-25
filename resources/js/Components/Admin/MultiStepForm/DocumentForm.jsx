// Libraries and Dependencies
import React from "react";
import { useForm, Controller } from "react-hook-form";
import { useForm as useInertiaForm } from '@inertiajs/react';

// Components
import { NavButton } from "@/Components/MultiStepForm/NavButton";

import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { FileInput } from "@/Components/FileInput";

export function DocumentForm() {
    const { prevStep, postFormDatatoServer } = useMultiStepForm();
    const { handleSubmit, control, formState: { errors } } = useForm({
    });

    const { errors:inertiaError } = useInertiaForm();

    function onFinalSubmit(submittedData) {

        postFormDatatoServer(submittedData);
    }

    console.log(inertiaError);

    return (
        <>
            <form>
                <div className="grid grid-cols-none lg:grid-cols-2 gap-16">
                    <div>
                        <label className="my-2 text-sm space-y-2 text-black">
                            <span>Resume File</span>
                            <Controller
                                name="resume_file"
                                control={control}
                                // rules={{
                                //     required: "Resume file is required.",
                                //     validate: (file) =>
                                //         file?.size <= 5 * 1024 * 1024 ||
                                //         "File size exceeds 5MB",
                                // }}
                                render={({ field }) => (
                                    <FileInput
                                    id={'resume_file'}
                                        file={field.value}
                                        onFileChange={(file) =>
                                            field.onChange(file)
                                        }
                                        error={errors}
                                    />
                                )}
                            />
                        </label>

                        <label className="my-2 text-sm space-y-2 text-black">
                            <span>Joining Letter</span>
                            <Controller
                                name="joining_letter"
                                control={control}
                                // rules={{
                                //     required: "Joining file is required.",
                                //     validate: (file) =>
                                //         file?.size <= 5 * 1024 * 1024 ||
                                //         "File size exceeds 5MB",
                                // }}
                                render={({ field }) => (
                                    <FileInput
                                     id={'joining_letter'}
                                        file={field.value}
                                        onFileChange={(file) =>
                                            field.onChange(file)
                                        }
                                        error={errors}

                                    />
                                )}
                            />
                        </label>
                    </div>
                    <div>
                        <label className="my-2 text-sm space-y-2 text-black">
                            <span>Offer Letter</span>
                            <Controller
                                name="offer_letter"
                                control={control}
                                // rules={{
                                //     required: "Offer letter is required.",
                                //     validate: (file) =>
                                //         file?.size <= 5 * 1024 * 1024 ||
                                //         "File size exceeds 5MB",
                                // }}
                                render={({ field }) => (
                                    <FileInput
                                    id={'offer_letter'}
                                        file={field.value}
                                        onFileChange={(file) =>
                                            field.onChange(file)
                                        }
                                        error={errors}

                                    />
                                )}
                            />
                        </label>
                        <label className="my-2 text-sm space-y-2 text-black">
                            <span>CSC Form 212</span>
                            <Controller
                                name="csc_form_212"
                                control={control}
                                // rules={{
                                //     required: "CSC Form is required.",
                                //     validate: (file) =>
                                //         file?.size <= 5 * 1024 * 1024 ||
                                //         "File size exceeds 5MB",
                                // }}
                                render={({ field }) => (
                                    <FileInput
                                    id={'csc_form_212'}
                                        file={field.value}
                                        onFileChange={(file) =>
                                            field.onChange(file)
                                        }
                                        error={errors}
                                    />
                                )}
                            />
                        </label>
                    </div>
                </div>
                <div className={"flex justify-between mt-16"}>
                    <NavButton type={"prev"} onClick={prevStep}>
                        Back
                    </NavButton>
                    <NavButton
                        type={"submit"}
                        onClick={handleSubmit(onFinalSubmit)}
                    >
                        Submit
                    </NavButton>
                </div>
            </form>
        </>
    );
}
