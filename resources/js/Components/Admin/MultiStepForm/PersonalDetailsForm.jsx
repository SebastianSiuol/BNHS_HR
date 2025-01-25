// Libraries and Dependencies
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm, Controller } from "react-hook-form";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";

// Components
import CustomDatePicker from "@/Components/CustomDatePicker";
import { InputSelect } from "@/Components/InputSelect";
import { LabelInput } from "@/Components/LabelInput";
import { NavButton } from "@/Components/MultiStepForm/NavButton";

// Hooks and Contexts
import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";

import { personalDataSchema } from "@/Schemas/MultistepFormSchema";

dayjs.extend(relativeTime);

const eighteenYearsAgo = dayjs().subtract(18, "year");

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

    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    function onFirstFormSubmit(e) {
        e.preventDefault;
        nextStep();
    }

    return (
        <>
            <form encType={"multi-part/formdata"}>
                {/* First Row! */}
                <div className="grid grid-cols-none lg:grid-cols-4 gap-4">
                    <LabelInput
                        id={"first_name"}
                        register={register}
                        label={"First Name"}
                        error={errors}
                    />

                    <LabelInput
                        id={"middle_name"}
                        register={register}
                        label={"Middle Name (Optional)"}
                        error={errors}
                    />
                    <LabelInput
                        id={"last_name"}
                        register={register}
                        label={"Last Name"}
                        error={errors}
                    />

                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Name Extension</span>
                        <InputSelect
                            id={"name_extension_id"}
                            register={register}
                        >
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
                        id={"place_of_birth"}
                        register={register}
                        label={"Place of Birth"}
                        error={errors}
                    />

                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Date of Birth</span>

                        <Controller
                            control={control}
                            name={"date_of_birth"}
                            render={({ field }) => (
                                <CustomDatePicker
                                    value={field}
                                    error={errors}
                                    name={"date_of_birth"}
                                    minimumDate={"1950-01-01"}
                                    maximumDate={eighteenYearsAgo.format(
                                        "YYYY-MM-DD"
                                    )}
                                />
                            )}
                        />
                    </label>

                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Sex</span>
                        <InputSelect id={"sex"} register={register}>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </InputSelect>
                    </label>

                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Civil Status</span>
                        <InputSelect id={"civil_status_id"} register={register}>
                            <option value="1">Single</option>
                            <option value="2">Married</option>
                            <option value="3">Widowed</option>
                            <option value="4">Separated</option>
                        </InputSelect>
                    </label>

                    <LabelInput
                        id={"contact_number"}
                        placeholder={'09xxxxxxxxx'}
                        register={register}
                        label={"Contact Number"}
                        error={errors}
                    />

                    <LabelInput
                        id={"telephone_number"}
                        register={register}
                        label={"Telephone Number (Optional)"}
                        error={errors}
                    />

                    <LabelInput
                        id={"contact_person_name"}
                        register={register}
                        label={"Contact Person Name"}
                        error={errors}
                    />

                    <LabelInput
                        id={"contact_person_number"}
                        placeholder={'09xxxxxxxxx'}
                        register={register}
                        label={"Contact Person Number"}
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
        </>
    );
}
