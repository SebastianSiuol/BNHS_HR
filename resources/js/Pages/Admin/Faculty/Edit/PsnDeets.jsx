// Libraries and Dependencies
import { usePage, router } from "@inertiajs/react";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm, Controller, useController } from "react-hook-form";
import dayjs from "dayjs";

// Schemas
import { personalDataSchema } from "@/Schemas/MultistepFormSchema";

// Structural Components
import { ContentContainer } from "@/Components/ContentContainer.jsx";
import { ContentHeader } from "@/Components/ContentHeader.jsx";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";

// State Components
import { NavButton } from "@/Components/MultiStepForm/NavButton";
import { InputLabel } from "@/Components/InputLabel";
import { InputSelect } from "@/Components/InputSelect";
import { LabelInput } from "@/Components/LabelInput";
import CustomDatePicker from "@/Components/CustomDatePicker";

export default function PsnDeets() {
    return (
        <>
            <PageHeaders>Edit Faculty Account</PageHeaders>
            <ContentContainer>
                <ContentHeader>Personal Details</ContentHeader>
                <PersonalDetailsForm />
            </ContentContainer>
        </>
    );
}

function PersonalDetailsForm() {
    const { selectedFaculty } = usePage().props;

    const {
        register,
        handleSubmit,
        control,
        formState: { errors },
    } = useForm({
        resolver: zodResolver(personalDataSchema),
        defaultValues: selectedFaculty,
    });

    function onFormUpdate(updatedData, e) {
        console.log(updatedData);
        e.preventDefault();

        router.put(
            route("admin.faculty.update.psn-deets", selectedFaculty?.public_id),
            updatedData,
            {
                onError: (errors) => {
                    console.log(errors);
                },
            }
        );
    }

    const eighteenYearsAgo = dayjs().subtract(18, "year");

    return (
        <form encType={"multi-part/formdata"}>
            <div className="grid grid-cols-none lg:grid-cols-4 gap-4">
                {/* First Row! */}
                <LabelInput
                    id={"first_name"}
                    register={register}
                    label={"First Name"}
                    error={errors}
                />
                <LabelInput
                    id={"middle_name"}
                    register={register}
                    label={"Middle Name"}
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
                        error={errors}>
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
                {/* First Row! */}

                {/* Second Row */}
                <LabelInput
                    id={"place_of_birth"}
                    register={register}
                    label={"Place of Birth"}
                    error={errors}
                />
                <div className={"flex flex-col lg:my-2"}>
                    <InputLabel
                        labelFor={"date_of_birth"}
                        color={"black"}
                        width={"normal"}>
                        Date of Birth
                    </InputLabel>
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
                </div>
                <label className={"my-2 space-y-2 text-sm"}>
                    <span>Sex</span>
                    <InputSelect
                        id={"sex"}
                        register={register}>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </InputSelect>
                </label>
                <label className={"my-2 space-y-2 text-sm"}>
                    <span>Civil Status</span>
                    <InputSelect
                        id={"civil_status_id"}
                        register={register}>
                        <option value="1">Single</option>
                        <option value="2">Married</option>
                        <option value="3">Widowed</option>
                        <option value="4">Separated</option>
                    </InputSelect>
                </label>
                {/* Second Row */}

                {/* Third Row */}
                <LabelInput
                    id={"contact_number"}
                    register={register}
                    label={"Contact Number"}
                    error={errors}
                />
                <LabelInput
                    id={"telephone_number"}
                    register={register}
                    label={"Telephone Number"}
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
                    register={register}
                    label={"Contact Person Number"}
                    error={errors}
                />
                {/* Third Row */}
            </div>

            <div className={"flex justify-end mt-16"}>
                <NavButton
                    type={"submit"}
                    onClick={handleSubmit(onFormUpdate)}>
                    Update
                </NavButton>
            </div>
        </form>
    );
}