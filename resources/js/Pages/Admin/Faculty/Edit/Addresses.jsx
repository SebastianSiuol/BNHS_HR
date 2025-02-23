// Libraries and Dependencies
import { usePage, router } from "@inertiajs/react";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";

// Schemas
import { addressDataSchema } from "@/Schemas/MultistepFormSchema";

// Structural Components
import { ContentContainer } from "@/Components/ContentContainer.jsx";
import { ContentHeader } from "@/Components/ContentHeader.jsx";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";

// State Components
import { NavButton } from "@/Components/MultiStepForm/NavButton";
import { AddressFields } from '@/Components/AddressFields';

export default function Addresses() {
    return (
        <>
            <PageHeaders>Edit Faculty Account</PageHeaders>
            <ContentContainer>
                <ContentHeader>Addresses</ContentHeader>
                <AddressForm />
            </ContentContainer>
        </>
    );
}

function AddressForm() {
    const { selectedFaculty } = usePage().props;

    const {
        register,
        formState: { errors },
        handleSubmit,
        watch,
        setValue,
    } = useForm({
        resolver: zodResolver(addressDataSchema),
        defaultValues: selectedFaculty,
    });

    function onFormUpdate(data, e) {
        router.put(
            route("admin.faculty.update.address", selectedFaculty?.public_id),
            watch()
        );
    }

    return (
        <>
            <form>
                <div className="relative grid grid-cols-none lg:grid-cols-2 gap-16">
                    <label
                        className={
                            "absolute right-2 -top-20 my-2 py-1 px-4 text-sm font-bold"
                        }>
                        <input
                            type={"checkbox"}
                            {...register("sameAddress")}
                        />
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
                        disabled={watch("sameAddress")}
                    />
                </div>
                <div className={"flex justify-end mt-16"}>
                    <NavButton
                        type={"submit"}
                        onClick={handleSubmit(onFormUpdate)}>
                        Update
                    </NavButton>
                </div>
            </form>
        </>
    );
}