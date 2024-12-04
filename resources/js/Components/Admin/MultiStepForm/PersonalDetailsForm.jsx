import { useEffect } from "react";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";

import { LabeledInput } from "@/Components/LabeledInput";
import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";

const personalDataSchema = z.object({
    first_name: z.string().min(1, { message: "Required" }),
    middle_name: z.string().min(1, { message: "Required" }),
    last_name: z.string().min(1, { message: "Required" }),
    place_of_birth: z.string().min(1, { message: "Required" }),
    date_of_birth: z.string().min(1, { message: "Required" }),
    sex: z.string().min(1, { message: "Required" }),
    marital_status: z.string().min(1, { message: "Required" }),
    contact_number: z.string().min(1, { message: "Required" }),
    contact_person_name: z.string().min(1, { message: "Required" }),
    contact_person_number: z.string().min(1, { message: "Required" }),
});

const FORM_DATA_KEY = "first_form_local_data";

export function PersonalDetailsForm({ nextStep }) {
    const { nextForm } = useMultiStepForm();

    const {
        register,
        handleSubmit,
        formState: { errors },
        watch,
    } = useForm({
        resolver: zodResolver(personalDataSchema),
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

    // Persistantly Uplaods Form Data
    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    function onFirstFormSubmit(data, e) {
        e.preventDefault;
        nextForm(data);
        nextStep();
    }

    return (
        <form>
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
                <LabeledInput
                    id={"name_extension"}
                    register={register}
                    label={"Name Extension"}
                    placeholder={"Name Extension"}
                    color={"black"}
                    width={"normal"}
                    error={errors}
                />
                <LabeledInput
                    id={"place_of_birth"}
                    register={register}
                    label={"Place of Birth"}
                    placeholder={"Place of Birth"}
                    color={"black"}
                    width={"normal"}
                    error={errors}
                />
                <LabeledInput
                    id={"date_of_birth"}
                    register={register}
                    label={"Date of Birth"}
                    placeholder={"Date of Birth"}
                    color={"black"}
                    width={"normal"}
                    error={errors}
                />
                <LabeledInput
                    id={"sex"}
                    register={register}
                    label={"Sex"}
                    placeholder={"Sex"}
                    color={"black"}
                    width={"normal"}
                    error={errors}
                />
                <LabeledInput
                    id={"marital_status"}
                    register={register}
                    label={"Marital Status"}
                    placeholder={"Marital Status"}
                    color={"black"}
                    width={"normal"}
                    error={errors}
                />
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

            <div className={"flex justify-end"}>
                <button
                    // disabled={isSubmitting}
                    onClick={handleSubmit(onFirstFormSubmit)}
                    className={
                        "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    }
                >
                    Next: Address
                </button>
            </div>
        </form>
    );
}

{
    /*<InputContainer>
        <InputLabel
            labelFor="name_extension"
            color={"black"}
            thickness={"normal"}
        >
            Name Extension
        </InputLabel>

        <InputSelect
            id={"name_extension"}
            value={data.name_extension}
            onChange={(e) => {
                setData("name_extension", e.target.value);
            }}
        >
            <option value={"0"}>None</option>
            <option value={"1"}>Sr.</option>
            <option value={"2"}>Jr.</option>
            <option value={"3"}>I</option>
            <option value={"4"}>II</option>
            <option value={"5"}>III</option>
            <option value={"6"}>IV</option>
            <option value={"7"}>V</option>
        </InputSelect>
    </InputContainer>
</div> */
}
