// Libraries and Dependencies
import { useEffect, useState } from "react";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { useForm, Controller, useController } from "react-hook-form";
import "react-datepicker/dist/react-datepicker.css";

// Components
import CustomDatePicker from "@/Components/CustomDatePicker";
import { InputLabel } from "@/Components/InputLabel";
import { InputSelect } from "@/Components/InputSelect";
import { LabeledInput } from "@/Components/LabeledInput";
import { NavButton } from "@/Components/MultiStepForm/NavButton";


// Hooks and Contexts
import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";

import { personalDataSchema } from "@/Schemas/MultistepFormSchema";


dayjs.extend(relativeTime);

const eighteenYearsAgo = dayjs().subtract(18, 'year');

const FORM_DATA_KEY = "first_form_local_data";

export function PersonalDetailsForm() {
    const { getSavedData, nextStep } = useMultiStepForm();

    const {
        register,
        handleSubmit,
        formState: { errors },
        watch,
        control,
    } = useForm({
        resolver: zodResolver(personalDataSchema),
        defaultValues: getSavedData(FORM_DATA_KEY),
    });

    const { field } = useController({
        control: control,
        name: "date_of_birth"
    });

    // Persistantly Uplaods Form Data
    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    function onFirstFormSubmit(e) {
        e.preventDefault;
        nextStep();
    }

    return (
        <form encType={'multi-part/formdata'}>
            {/* First Row! */}
            <div className="grid grid-cols-none lg:grid-cols-4 gap-4">
                <LabeledInput
                    id={"first_name"}
                    register={register}
                    label={"First Name"}
                    placeholder={"First Name"}
                    color={"black"}
                    width={"normal"}
                    error={errors}
                />
                <LabeledInput
                    id={"middle_name"}
                    register={register}
                    label={"Middle Name"}
                    placeholder={"Middle Name"}
                    color={"black"}
                    width={"normal"}
                    error={errors}
                />
                <LabeledInput
                    id={"last_name"}
                    register={register}
                    label={"Last Name"}
                    placeholder={"Last Name"}
                    color={"black"}
                    width={"normal"}
                    error={errors}
                />

                <div className={"my-2"}>
                    <InputLabel
                        labelFor={"name_extension_id"}
                        color={"black"}
                        width={"normal"}
                    >
                        Name Extension
                    </InputLabel>

                    <InputSelect id={"name_extension_id"} register={register}>
                        <option value="1">None</option>
                        <option value="2">Sr. </option>
                        <option value="3">Jr. </option>
                        <option value="4">I</option>
                        <option value="5">II</option>
                        <option value="6">III</option>
                        <option value="7">IV</option>
                        <option value="8">V</option>
                    </InputSelect>
                </div>

                <LabeledInput
                    id={"place_of_birth"}
                    register={register}
                    label={"Place of Birth"}
                    placeholder={"Place of Birth"}
                    color={"black"}
                    width={"normal"}
                    error={errors}
                />

                <div className={"flex flex-col lg:my-2"}>
                    <InputLabel
                        labelFor={"date_of_birth"}
                        color={"black"}
                        width={"normal"}
                    >
                        Date of Birth
                    </InputLabel>

                    <Controller control={control} name={'date_of_birth'}
                        render={({ field }) => (
                            <CustomDatePicker value={field} error={errors} name={'date_of_birth'} minimumDate={'1950-01-01'} maximumDate={eighteenYearsAgo.format('YYYY-MM-DD')}/>
                        )}/>
                </div>

                 <div className={"my-2"}>
                    <InputLabel
                        labelFor={"sex"}
                        color={"black"}
                        width={"normal"}
                    >
                        Sex
                    </InputLabel>

                    <InputSelect id={"sex"} register={register} defaultValues={'Male'}>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </InputSelect>
                </div>




                <div className={"my-2"}>
                    <InputLabel
                        labelFor={"civil_status_id"}
                        color={"black"}
                        width={"normal"}
                    >
                        Civil Status
                    </InputLabel>

                    <InputSelect id={"civil_status_id"} register={register}>
                        <option value="1">Single</option>
                        <option value="2">Married</option>
                        <option value="3">Widowed</option>
                        <option value="4">Separated</option>
                    </InputSelect>
                </div>
                <LabeledInput
                    id={"contact_number"}
                    register={register}
                    label={"Contact Number"}
                    placeholder={"Contact Number"}
                    color={"black"}
                    width={"normal"}
                    error={errors}
                />
                <LabeledInput
                    id={"telephone_number"}
                    register={register}
                    label={"Telephone Number"}
                    placeholder={"Telephone Number"}
                    color={"black"}
                    width={"normal"}
                    error={errors}
                />
                <LabeledInput
                    id={"contact_person_name"}
                    register={register}
                    label={"Contact Person Name"}
                    placeholder={"Contact Person Name"}
                    color={"black"}
                    width={"normal"}
                    error={errors}
                />
                <LabeledInput
                    id={"contact_person_number"}
                    register={register}
                    label={"Contact Person Number"}
                    placeholder={"Contact Person Number"}
                    color={"black"}
                    width={"normal"}
                    error={errors}
                />
            </div>

            <div className={"flex justify-end mt-16"}>
                <NavButton
                    type={"next"}
                    onClick={handleSubmit(onFirstFormSubmit)}
                >
                    Next: Address
                </NavButton>
            </div>
        </form>
    );
}
