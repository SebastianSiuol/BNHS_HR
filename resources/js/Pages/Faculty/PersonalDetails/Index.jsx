import { useState, useEffect } from "react";
import { usePage, router } from "@inertiajs/react";
import { Description, DialogTitle } from "@headlessui/react";
import { useForm, Controller } from "react-hook-form";

import Pagination from "@/Components/Pagination";
import Modal from "@/Components/Modal";
import CustomIcon from "@/Components/CustomIcon";
import { FileInput } from "@/Components/FileInput";
import { ContentContainer } from "@/Components/ContentContainer";
import { ContentHeader } from "@/Components/ContentHeader";
import { Table, TableRow } from "@/Components/Table";

import { PersonalInformation } from "@/Components/Faculty/PersonalDetails/PersonalInformation";
import { FamilyBackground } from "@/Components/Faculty/PersonalDetails/FamilyBackground";
import { EducationalBackground } from "@/Components/Faculty/PersonalDetails/EducationalBackground";
import { CivilServiceEligibility } from "@/Components/Faculty/PersonalDetails/CivilServiceEligibility";
import { VoluntaryWork } from "@/Components/Faculty/PersonalDetails/VoluntaryWork";
import { WorkExperience } from "@/Components/Faculty/PersonalDetails/WorkExperience";
import { LearningAndDevelopment } from "@/Components/Faculty/PersonalDetails/LearningAndDevelopment";
import { OtherInformation } from "@/Components/Faculty/PersonalDetails/OtherInformation";

export default function Index() {
    return (
        <>
            <HandlePage />
        </>
    );
}

function HandlePage() {
    const SIDEBAR_KEY = "psnDeetsTabState";

    const [activeTab, setActiveTab] = useState(() => {
        const savedTabs = sessionStorage.getItem(SIDEBAR_KEY);
        return savedTabs ? JSON.parse(savedTabs) : {};
    });

    const formComponents = {
        personalInfo: <PersonalInformation />,
        familyBackground: <FamilyBackground />,
        educBackground: <EducationalBackground />,
        civilService: <CivilServiceEligibility />,
        workExperience: <WorkExperience />,
        voluntaryWork: <VoluntaryWork />,
        learningDevelopment: <LearningAndDevelopment />,
        otherInformation: <OtherInformation />,
    };

    useEffect(
        function () {
            sessionStorage.setItem(SIDEBAR_KEY, JSON.stringify(activeTab));
        },
        [activeTab]
    );

    function handleTab(tab) {
        setActiveTab(tab);
    }

    return (
        <div className={"min-w-[90vw]"}>
            <Header />
            <div className={"flex mt-6"}>
                <TabNavigation
                    activeTab={activeTab}
                    onTabClick={handleTab}
                />
                <div className="w-3/4 ml-6">{formComponents[activeTab]}</div>
            </div>
        </div>
    );
}

function Header() {
    async function handlePDSDownload() {
        try {
            const response = await fetch(route("faculty.export.pds"));
            const blob = await response.blob();

            const href = window.URL.createObjectURL(blob);
            const link = document.createElement("a");
            link.href = href;
            link.setAttribute("download", 'pds.xlsx');

            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        } catch (err) {
            console.error("Error:", err);
            return Promise.reject({ Error: "Something Went Wrong", err });
        }
    }

    return (
        <div className="flex justify-between items-center bg-white shadow p-4 rounded-lg">
            <h1 className="text-xl font-bold text-gray-800">
                Faculty Information
            </h1>
            <button
                onClick={handlePDSDownload}
                className="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                Export PDS
            </button>
        </div>
    );
}

function TabNavigation({ activeTab, onTabClick }) {
    function handleTab(tab) {
        onTabClick(tab);
    }

    function mergedClass(...classes) {
        return classes.filter(Boolean).join(" ");
    }

    const baseClass = "flex items-center w-full p-2 transition duration-75 rounded-lg group hover:bg-gray-100 hover:text-blue-900";
    const activeClass = "bg-white text-blue-900 font-semibold";
    const inactiveClass = "text-gray-300";

    const tabLinks = [
        { id: "personalInfo", label: "Personal Information" },
        { id: "familyBackground", label: "Family Background" },
        { id: "educBackground", label: "Educational Background" },
        { id: "civilService", label: "Civil Service Eligibility" },
        { id: "workExperience", label: "Work Experience" },
        { id: "voluntaryWork", label: "Voluntary Work" },
        { id: "learningDevelopment", label: "Learning and Development" },
        { id: "otherInformation", label: "Other Information" },
    ];

    return (
        <div className="w-1/4 bg-blue-900 shadow p-4 rounded-lg space-y-1">
            {tabLinks.map((tab) => (
                <button
                    key={tab.id}
                    onClick={() => handleTab(tab.id)}
                    className={mergedClass(baseClass, activeTab === tab.id ? activeClass : inactiveClass)}>
                    {tab.label}
                </button>
            ))}
        </div>
    );
}

function MainContent() {
    return <></>;
}
