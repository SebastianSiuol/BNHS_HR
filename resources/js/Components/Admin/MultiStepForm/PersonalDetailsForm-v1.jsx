import React from "react";
import { LabeledInput } from "@/Components/LabeledInput";
import { useMultiStepForm } from "@/Context/MultiStepFormContext";

export function PersonalDetailsForm({ nextStep, error }) {
    const { data, setData, firstStepFormFinish, errors } = useMultiStepForm();

    function handleNextStep() {
        firstStepFormFinish();
    }

    function handleChange(event) {
        const { id, value } = event.target;
        setData((data) => ({ ...data, [id]: value }));
    }

    return (
        <div>
            {/* First Row! */}
            <div className="grid grid-cols-none lg:grid-cols-4 gap-4">
                <LabeledInput
                    id={"first_name"}
                    label={"First Name"}
                    placeholder={"First Name"}
                    color={"black"}
                    width={"normal"}
                    required={true}
                    error={errors.first_name}
                    value={data.first_name}
                    onChange={handleChange}
                />
                <LabeledInput
                    id={"middle_name"}
                    label={"Middle Name"}
                    placeholder={"Middle Name"}
                    color={"black"}
                    width={"normal"}
                    required={true}
                    error={error?.middle_name}
                    value={data.middle_name}
                    onChange={handleChange}
                />
                <LabeledInput
                    label={"Last Name"}
                    placeholder={"Last Name"}
                    color={"black"}
                    width={"normal"}
                    required={true}
                    id={"last_name"}
                    error={error?.last_name}
                    value={data.last_name}
                    onChange={handleChange}
                />
                <LabeledInput
                    id={"name_extension"}
                    label={"Name Extension"}
                    placeholder={"Name Extension"}
                    color={"black"}
                    width={"normal"}
                    required={true}
                    error={error?.name_extension}
                    value={data.name_extension}
                    onChange={handleChange}
                />
            </div>

            {/* Second Row! */}
            <div className="grid grid-cols-none lg:grid-cols-4 gap-4">
                <LabeledInput
                    label={"Place of Birth"}
                    placeholder={"Place of Birth"}
                    color={"black"}
                    width={"normal"}
                    required={true}
                    id={"place_of_birth"}
                    error={error?.place_of_birth}
                    value={data.place_of_birth}
                    onChange={handleChange}
                />
                <LabeledInput
                    label={"Date of Birth"}
                    placeholder={"Date of Birth"}
                    color={"black"}
                    width={"normal"}
                    required={true}
                    id={"date_of_birth"}
                    error={error?.date_of_birth}
                    value={data.date_of_birth}
                    onChange={handleChange}
                />
                <LabeledInput
                    label={"Sex"}
                    placeholder={"Sex"}
                    color={"black"}
                    width={"normal"}
                    required={true}
                    id={"sex"}
                    error={error?.sex}
                    value={data.sex}
                    onChange={handleChange}
                />
                <LabeledInput
                    label={"Marital Status"}
                    placeholder={"Marital Status"}
                    color={"black"}
                    width={"normal"}
                    required={true}
                    id={"marital_status"}
                    error={error?.marital_status}
                    value={data.marital_status}
                    onChange={handleChange}
                />
            </div>

            {/* Third Row! */}
            <div className="grid grid-cols-none lg:grid-cols-4 gap-4">
                <LabeledInput
                    label={"Contact Number"}
                    placeholder={"Contact Number"}
                    color={"black"}
                    width={"normal"}
                    required={true}
                    id={"contact_number"}
                    error={error?.contact_number}
                    value={data.contact_number}
                    onChange={handleChange}
                />
                <LabeledInput
                    label={"Telephone Number"}
                    placeholder={"Telephone Number"}
                    color={"black"}
                    width={"normal"}
                    required={true}
                    id={"telephone_number"}
                    error={error?.telephone_number}
                    value={data.telephone_number}
                    onChange={handleChange}
                />
                <LabeledInput
                    label={"Contact Person Name"}
                    placeholder={"Contact Person Name"}
                    color={"black"}
                    width={"normal"}
                    required={true}
                    id={"contact_person_name"}
                    error={error?.contact_person_name}
                    value={data.contact_person_name}
                    onChange={handleChange}
                />
                <LabeledInput
                    label={"Contact Person Number"}
                    placeholder={"Contact Person Number"}
                    color={"black"}
                    width={"normal"}
                    required={true}
                    id={"contact_person_number"}
                    error={error?.contact_person_number}
                    value={data.contact_person_number}
                    onChange={handleChange}
                />
            </div>

            <div className={"flex justify-end"}>
                <button
                    onClick={handleNextStep}
                    className={
                        "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    }
                >
                    Next: Address
                </button>
            </div>
        </div>
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
