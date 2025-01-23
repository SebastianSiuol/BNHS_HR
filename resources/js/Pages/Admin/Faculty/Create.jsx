import { useState } from "react";
import { useForm } from "@inertiajs/react";

// Components
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";
import { ContentContainer } from "@/Components/ContentContainer.jsx";
import { ContentHeader } from "@/Components/ContentHeader.jsx";
import { NavStepper } from "@/Components/MultiStepForm/NavStepper";
import { MultiStepFormProvider, useMultiStepForm } from "@/Context/MultiStepFormContext";

// Forms
import { PersonalDetailsForm } from "@/Components/Admin/MultiStepForm/PersonalDetailsForm.jsx";
import { AccountLoginForm } from "@/Components/Admin/MultiStepForm/AccountLoginForm";
import { AddressForm } from "@/Components/Admin/MultiStepForm/AddressForm";
import { CompanyDetailsForm } from "@/Components/Admin/MultiStepForm/CompanyDetailsForm";
import { DocumentForm } from "@/Components/Admin/MultiStepForm/DocumentForm";
import { RolesForm } from "@/Components/Admin/MultiStepForm/RolesForm";

export default function Create() {
    return (
        <>
                <PageHeaders>Create a Faculty Account</PageHeaders>
                <MultiStepFormProvider>
                    <FormHandling />
                </MultiStepFormProvider>
        </>
    );
}

function FormHandling() {
    const { step } = useMultiStepForm();

    const headerValue = [
        "Personal Details",
        "Address",
        "Account Login",
        "Company Details",
        "Roles",
        "Documents",
    ];

    const formComponents = [
        <PersonalDetailsForm />,
        <AddressForm />,
        <AccountLoginForm />,
        <CompanyDetailsForm />,
        <RolesForm />,
        <DocumentForm  />,
    ];


    return (
        <>
            <ol
                className={
                    "mb-6 space-y-4 lg:justify-between lg:flex lg:space-x-8 lg:space-y-0"
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
                    <ContentHeader>
                        {headerValue[step]}
                    </ContentHeader>

                    {formComponents[step]}
            </ContentContainer>
        </>
    );
}


export function NavButton({ type, onClick, disabled=false, children }) {

    // prev, next, submit
    const buttonStyle = {
        'prev': "text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800",
        'next': "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800",
        'submit': "text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800",
    };

    return (
        <button onClick={onClick} className={buttonStyle[type]} disabled={disabled}>
            {children}
        </button>
    );
}
