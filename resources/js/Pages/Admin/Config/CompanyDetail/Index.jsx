import { useForm } from "react-hook-form";

// Components
import { LabeledInput } from "@/Components/LabeledInput";
import { ContentContainer } from "@/Components/ContentContainer";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";

export default function Index() {
    return (
        <>
            <PageHeaders>Company Details</PageHeaders>
            <ContentContainer type="noOutline">
                <HandlePage />
            </ContentContainer>
        </>
    );
}

function HandlePage() {
  const { register, handleSubmit, formState: { errors } } = useForm({});

    return (
        <>
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <LabeledInput
                        id={"name"}
                        register={register}
                        label={"Company Name"}
                        placeholder={"Company Name"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />
            </div>
        </>
    );
}
