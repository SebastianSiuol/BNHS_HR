import { useState } from "react";
import { useForm } from "@inertiajs/react";

// import { useMultiStepForm } from "@/Context/MultiStepFormContext";

// Components
import { AuthenticatedAdminLayout } from "@/Layouts/AuthenticatedAdminLayout.jsx";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";
import { ContentContainer } from "@/Components/ContentContainer.jsx";
import { MultiStepFormProvider, useMultiStepForm } from "@/Context/MultiStepFormContext";

// Forms
import { PersonalDetailsForm } from "@/Components/Admin/MultiStepForm/PersonalDetailsForm.jsx";
import { AccountLoginForm } from "@/Components/Admin/MultiStepForm/AccountLoginForm";
import { AddressForm } from "@/Components/Admin/MultiStepForm/AddressForm";
import { CompanyDetailsForm } from "@/Components/Admin/MultiStepForm/CompanyDetailsForm";
import { DocumentForm } from "@/Components/Admin/MultiStepForm/DocumentForm";
import { AuthSidebarProvider } from "@/Context/AuthSidebarContext";

export default function Create() {
    return (
        <>
            <AuthenticatedAdminLayout>
                <PageHeaders>Create a Faculty Account</PageHeaders>
                <MultiStepFormProvider>
                    <FormHandling />
                </MultiStepFormProvider>
            </AuthenticatedAdminLayout>
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
        "Documents",
    ];

    const formComponents = [
        <PersonalDetailsForm />,
        <AddressForm />,
        <AccountLoginForm />,
        <CompanyDetailsForm />,
        <DocumentForm  />,
    ];


    return (
        <>
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
                    <FormHeaders>
                        {headerValue[step]}
                    </FormHeaders>

                    {formComponents[step]}
            </ContentContainer>
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

function FormHeaders({children}) {
    return (
        <h1 className="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">

            {children}

        </h1>);
}


export function NavButton({ type, onClick, children }) {

    // prev, next, submit
    const buttonStyle = {
        'prev': "text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800",
        'next': "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800",
        'submit': "text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800",
    };

    return (
        <button onClick={onClick} className={buttonStyle[type]}>
            {children}
        </button>
    );
}
