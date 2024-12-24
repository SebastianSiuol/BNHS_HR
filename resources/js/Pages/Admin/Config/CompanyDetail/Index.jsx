import { useState, useEffect } from "react";
import { useForm } from "react-hook-form";
import { usePage, router } from "@inertiajs/react";

// Components
import { LabelInput } from "@/Components/LabelInput";
import { Buttons } from "@/Components/Buttons";
import { ContentContainer } from "@/Components/ContentContainer";
import { ContentHeader } from "@/Components/ContentHeader";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";

export default function Index() {
    return (
        <>
            <PageHeaders>Company Details</PageHeaders>
            <ContentContainer type="noOutline">
                <ContentHeader>Company Details</ContentHeader>
                <HandlePage />
            </ContentContainer>
        </>
    );
}

function HandlePage() {
    const { companyDetails, isDetailsEmpty } = usePage().props;

    const [inputEditable, setInputEditable] = useState(isDetailsEmpty);
    const [detailsUpdateable, setDetailsUpdateable] = useState(!isDetailsEmpty);

    const {
        register,
        handleSubmit,
        formState: { errors },
        reset,
    } = useForm();

        // Populate the form when `companyDetails` is available
        useEffect(() => {
            if (companyDetails) {
                reset(companyDetails);
            }
        }, [companyDetails, reset]);

    function handleDetailsSubmit(data, e) {
        e.preventDefault();
        router.post(route("admin.config.company-details.store"), data, {
            onSuccess: ()=>{setInputEditable(false);}
        });
    }

    function handleDetailsEdit(e) {
        e.preventDefault();
        setInputEditable(true);
        setDetailsUpdateable(true);
    }
    // admin.config.company-details.update
    function handleDetailsUpdate(data, e){
        e.preventDefault();
        router.patch(route("admin.config.company-details.update"), data, {
            onSuccess: ()=>{setInputEditable(false), setDetailsUpdateable(false)}
        });
    }

    console.log("DEBUG: mounted");
    console.log(inputEditable);
    console.log(isDetailsEmpty);

    return (
        <>
            <form>
                <div className={"grid gap-x-4 mb-4 sm:grid-cols-3"}>
                    <LabelInput
                        id={"company_name"}
                        label={"Company Name"}
                        register={register}
                        disabled={!inputEditable}
                        error={errors}
                    />
                    <LabelInput
                        id={"contact_number"}
                        label={"Contact Number"}
                        placeholder={"09 xxx xxx xxxxx"}
                        register={register}
                        disabled={!inputEditable}
                        error={errors}
                    />
                    <LabelInput
                        id={"email"}
                        label={"Email"}
                        placeholder={"company@email.com"}
                        register={register}
                        disabled={!inputEditable}
                        error={errors}
                    />
                    <LabelInput
                        id={"website_url"}
                        label={"Website URL"}
                        placeholder={"company.domain"}
                        register={register}
                        disabled={!inputEditable}
                        error={errors}
                    />
                    <LabelInput
                        id={"company_address"}
                        label={"Company Address"}
                        register={register}
                        disabled={!inputEditable}
                        error={errors}
                    />
                    <LabelInput
                        id={"city"}
                        label={"City"}
                        register={register}
                        disabled={!inputEditable}
                        error={errors}
                    />
                    <LabelInput
                        id={"state"}
                        label={"State"}
                        register={register}
                        disabled={!inputEditable}
                        error={errors}
                    />
                    <LabelInput
                        id={"postal_code"}
                        label={"Postal Code"}
                        register={register}
                        disabled={!inputEditable}
                        error={errors}
                    />
                    <LabelInput
                        id={"country"}
                        label={"Country"}
                        placeholder={"Philippines"}
                        register={register}
                        disabled={!inputEditable}
                        error={errors}
                    />
                </div>

                <div className={"flex items-center justify-end mt-4 space-x-4"}>
                    {(isDetailsEmpty) && (
                        <Buttons
                            type={"submit"}
                            onClick={handleSubmit(handleDetailsSubmit)}
                        >
                            Save
                        </Buttons>
                    )}
                    {(!isDetailsEmpty || !detailsUpdateable) && (
                        <Buttons
                            type={"edit"}
                            onClick={handleDetailsEdit}
                        >
                            Edit
                        </Buttons>
                    )}

                    {(detailsUpdateable && inputEditable) && (
                        <Buttons
                        type={"submit"}
                        onClick={handleSubmit(handleDetailsUpdate)}
                    >
                        Update
                    </Buttons>
                    )}
                </div>
            </form>
        </>
    );
}
