import { useEffect } from "react";

import { ContentContainer } from "@/Components/ContentContainer";
import { ContentHeader } from "@/Components/ContentHeader";
import { LabeledInput, InputShow, Label } from "@/Components/LabeledInput";
import { getFullName } from '@/Utils/formatTableDataUtils';

import { useFacultiesIndex } from "@/Context/FacultiesIndexContext";

export function Show() {
    const { isLoading } = useFacultiesIndex();

    if (isLoading) return <p className={'text-bold text-xl mb-16'}>Loading...</p>;

    return (
        <>
            <div className="lg:flex mt-5 mr-5">
                <PersonalDetails />
                <div className="block ml-4 space-y-4">
                    <AccountDetails />
                    <CompanyDetails />
                </div>
            </div>
        </>
    );
}

function PersonalDetails() {
    const { selectedFacultyDetails } = useFacultiesIndex();
    const { personal_information, addresses } = selectedFacultyDetails;

    // Grouped fields for personal information
    const personalFields = [
        { id: "first_name", label: "First Name", value: personal_information.first_name ?? 'N/A' },
        { id: "middle_name", label: "Middle Name", value: personal_information.middle_name ?? 'N/A' },
        { id: "last_name", label: "Last Name", value: personal_information.last_name ?? 'N/A' },
        { id: "name_extension", label: "Name Extension", value: personal_information.name_extension ?? 'N/A' },
        { id: "place_of_birth", label: "Place of Birth", value: personal_information.place_of_birth ?? 'N/A' },
        { id: "date_of_birth", label: "Date of Birth", value: personal_information.date_of_birth ?? 'N/A' },
        { id: "sex", label: "Sex", value: personal_information.sex ?? 'N/A' },
        { id: "civil_status", label: "Civil Status", value: personal_information.civil_status ?? 'N/A' },
        { id: "contact_number", label: "Contact Number", value: personal_information.contact_number ?? 'N/A' },
        { id: "telephone_number", label: "Telephone Number", value: personal_information.telephone_number ?? 'N/A' },
        { id: "contact_person_name", label: "Contact Person Name", value: personal_information.contact_person_name ?? 'N/A' },
        { id: "contact_person_number", label: "Contact Person Number", value: personal_information.contact_person_number ?? 'N/A' },
    ];

    // Grouped fields for addresses
    const addressFields = [
        {
            title: "Residential Address",
            fields: [
                { id: "residential_houseNumber", label: "House/Block/Lot No.", value: addresses.residential_houseNumber ?? 'N/A' },
                { id: "residential_street", label: "Street", value: addresses.residential_street ?? 'N/A' },
                { id: "residential_subdivision", label: "Subdivision/Village", value: addresses.residential_subdivision ?? 'N/A' },
                { id: "residential_barangay", label: "Barangay", value: addresses.residential_barangay ?? 'N/A' },
                { id: "residential_city", label: "City/Municipality", value: addresses.residential_city ?? 'N/A' },
                { id: "residential_province", label: "Province", value: addresses.residential_province ?? 'N/A' },
                { id: "residential_zip_code", label: "Zip Code", value: addresses.residential_zipCode ?? 'N/A' },
            ],
        },
        {
            title: "Permanent Address",
            fields: [
                { id: "permanent_house_num", label: "House/Block/Lot No.", value: addresses.permanent_houseNumber ?? 'N/A' },
                { id: "permanent_street", label: "Street", value: addresses.permanent_street ?? 'N/A' },
                { id: "permanent_subdivision", label: "Subdivision/Village", value: addresses.permanent_subdivision ?? 'N/A' },
                { id: "permanent_barangay", label: "Barangay", value: addresses.permanent_barangay ?? 'N/A' },
                { id: "permanent_city", label: "City/Municipality", value: addresses.permanent_city ?? 'N/A' },
                { id: "permanent_province", label: "Province", value: addresses.permanent_province ?? 'N/A' },
                { id: "permanent_zip_code", label: "Zip Code", value: addresses.permanent_zipCode ?? 'N/A' },
            ],
        },
    ];

    return (
        <>
            <div className="pb-5 pl-5 flex-1">
                <ContentContainer>
                    <ContentHeader>Personal Details</ContentHeader>

                    <DynamicFieldGrid fields={personalFields} />

                    <div>
                        <div className="bg-blue-950 my-5 h-px w-full"></div>
                    </div>

                    {/* Render Addresses */}
                    {addressFields.map((section, index) => (
                        <AddressSection key={index} title={section.title} fields={section.fields} />
                    ))}
                </ContentContainer>
            </div>
        </>
    );
}

function AccountDetails() {
    const { selectedFacultyDetails } = useFacultiesIndex();

    return (
        <>
            <ContentContainer>
                <div className="space-y-4">
                    <ContentHeader>Account Details</ContentHeader>

                    <div className="grid grid-cols-2">
                        <Label label={"Email"} color={"black"} width={"normal"} />
                        <InputShow id={"email"} value={selectedFacultyDetails.email} />
                    </div>
                </div>
            </ContentContainer>
        </>
    );
}

function CompanyDetails() {
    const { selectedFacultyDetails } = useFacultiesIndex();
    const { faculty_code, designation, shift, date_of_joining, department_head } = selectedFacultyDetails;
    const { department } = designation;

    console.log(department_head);

    return (
        <>
            <ContentContainer>
                <ContentHeader>Company Details</ContentHeader>
                <div className={"lg:space-y-4"}>
                    <TwoColumnContainer>
                        <Label label={"Faculty Code"} color={"black"} width={"normal"} />
                        <InputShow id={"faculty_code"} value={faculty_code} />
                    </TwoColumnContainer>
                    <TwoColumnContainer>
                        <Label label={"Department"} color={"black"} width={"normal"} />
                        <InputShow id={"department"} value={department} />
                    </TwoColumnContainer>
                    <TwoColumnContainer>
                        <Label label={"Designation"} color={"black"} width={"normal"} />
                        <InputShow id={"designation"} value={designation.name} />
                    </TwoColumnContainer>
                    <TwoColumnContainer>
                        <Label label={"Date of Joining"} color={"black"} width={"normal"} />
                        <InputShow id={"date_of_joining"} value={date_of_joining} />
                    </TwoColumnContainer>
                    <TwoColumnContainer>
                        <Label label={"Manager/Department Head"} color={"black"} width={"normal"} />
                        <InputShow id={"depart_head"} value={getFullName(department_head?.personal_information)} />
                    </TwoColumnContainer>
                    <TwoColumnContainer>
                        <Label label={"Shift"} color={"black"} width={"normal"} />
                        <InputShow id={"shift"} value={shift} />
                    </TwoColumnContainer>
                </div>
            </ContentContainer>
        </>
    );
}

const DynamicFieldGrid = ({ fields }) => (
    <FourColumnContainer>
        {fields.map(({ id, label, value }) => (
            <LabeledInput key={id} id={id} value={value} label={label} color="black" width="normal" inputType="show" />
        ))}
    </FourColumnContainer>
);

const AddressSection = ({ title, fields }) => (
    <div className="mt-4">
        <h6 className="font-semibold text-blue-950">{title}</h6>
        <TwoColumnContainer>
            {fields.map(({ id, label, value,  i}) => (
                <LabeledInput key={id} id={id} value={value} label={label} color="black" width="normal" inputType="show" />
            ))}
        </TwoColumnContainer>
    </div>
);


function FourColumnContainer({ children }) {
    return <div className="grid grid-cols-none lg:grid-cols-4 gap-4">{children}</div>;
}

function TwoColumnContainer({ children }) {
    return <div className="grid grid-cols-none lg:grid-cols-2 gap-4">{children}</div>;
}
