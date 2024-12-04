import { useState } from "react";
import { useForm } from "@inertiajs/react";

// Components
import { AuthenticatedAdminLayout } from "@/Layouts/AuthenticatedAdminLayout.jsx";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";
import { ContentContainer } from "@/Components/ContentContainer.jsx";
import { MultistepFormHeaders } from "@/Components/Admin/MultiStepForm/MultistepFormHeaders.jsx";
import { MultiStepFormProvider } from "@/Context/MultiStepFormContext";

// Forms
import { PersonalDetailsForm } from "@/Components/Admin/MultiStepForm/PersonalDetailsForm.jsx";
import { AccountLoginForm } from "@/Components/Admin/MultiStepForm/AccountLoginForm";
import { AddressForm } from "@/Components/Admin/MultiStepForm/AddressForm";
import { CompanyDetailsForm } from "@/Components/Admin/MultiStepForm/CompanyDetailsForm";
import { DocumentForm } from "@/Components/Admin/MultiStepForm/DocumentForm";

export default function Create({ auth }) {
    const [step, setStep] = useState(0);

    const headerValue = [
        "Personal Details",
        "Address",
        "Account Login",
        "Company Details",
        "Documents",
    ];

    function goToNextStep() {
        if (step < headerValue.length) setStep((step) => step + 1);

        return step;
    }

    function goToPrevStep() {
        if (step > 0) setStep((step) => step - 1);

        return step;
    }

    const formComponents = [
        <PersonalDetailsForm nextStep={goToNextStep} />,
        <AddressForm prevStep={goToPrevStep} nextStep={goToNextStep} />,
        <AccountLoginForm prevStep={goToPrevStep} nextStep={goToNextStep} />,
        <CompanyDetailsForm prevStep={goToPrevStep} nextStep={goToNextStep} />,
        <DocumentForm prevStep={goToPrevStep} />,
    ];

    return (
        <>
            <AuthenticatedAdminLayout>
                <PageHeaders>Create a Faculty Account</PageHeaders>
                <ol
                    className={
                        "items-center w-full mb-6 space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse"
                    }
                >
                    {headerValue.map((header, index) => (
                        <NavStepper
                            step={step}
                            header={header}
                            index={index}
                            key={header}
                        />
                    ))}
                </ol>
                <ContentContainer>
                    <MultiStepFormProvider>
                        <MultistepFormHeaders>
                            {headerValue[step]}
                        </MultistepFormHeaders>

                        {formComponents[step]}
                    </MultiStepFormProvider>
                </ContentContainer>
            </AuthenticatedAdminLayout>
        </>
    );
}

function NavStepper({ header, index, step }) {
    const isActive = index === step;

    const listItemClass =
        "flex items-center space-x-2.5 rtl:space-x-reverse rounded-full shrink-0 ";
    const spanLabelClass =
        "flex items-center justify-center w-8 h-8 border rounded-full shrink-0 ";

    return (
        <li
            className={
                listItemClass + (isActive ? " text-blue-600" : " text-gray-500")}
        >
            <span
                className={
                    spanLabelClass + (isActive ? "  border-blue-600" : " border-gray-500")}
            >
                {index + 1}
            </span>
            <span>
                <h3 className={"font-medium leading-tight"}>{header}</h3>
            </span>
        </li>
    );
}
