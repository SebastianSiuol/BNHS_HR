import { useState, useEffect } from "react";
import { useForm, Controller } from "react-hook-form";
import { router } from "@inertiajs/react";
import dayjs from "dayjs";

import CustomDatePicker from "@/Components/CustomDatePicker";
import { LabelInput } from "@/Components/LabelInput";
import { EditSectionHeader } from "@/Components/Faculty/PersonalDetails/EditSectionHeader";
import { parse } from "uuid";

export function EducationalBackground() {
    const [ educBgData, setEducBgData ] = useState([]);

    const categories = [
        { title: "Elementary", fieldPrefix: "elementary" },
        { title: "Secondary", fieldPrefix: "secondary" },
        { title: "Vocational / Trade Course", fieldPrefix: "vocational" },
        { title: "College", fieldPrefix: "college" },
        { title: "Graduate Studies", fieldPrefix: "graduate" },
    ];

    useEffect(() => {
        async function fetchSchoolData() {
            try {
                const response = await fetch(route("educ-bg.get"), {
                    method: "GET",
                    headers: { "Content-Type": "application/json" },
                });

                if (!response.ok) {
                    console.error("An error has occured");
                }

                const parsedData = await response.json();

                setEducBgData(parsedData);

            } catch (error) {
                console.error(error);
            }
        }
        fetchSchoolData();
    }, []);

    return (
        <div className="bg-white shadow p-6 rounded-lg">
            <div className="flex justify-between items-center border-b pb-4 mb-4">
                <div>
                    <h2 className="text-lg font-bold text-gray-800">
                        Educational Background
                    </h2>
                </div>
            </div>
            <Elementary educBgData={educBgData}/>
            <Secondary educBgData={educBgData}/>
            <Vocational educBgData={educBgData}/>
            <College educBgData={educBgData}/>
            <Graduate educBgData={educBgData}/>
        </div>
    );
}

function Elementary({ educBgData }) {
    const [isInputEditable, setIsInputEditable] = useState(false);
    const [publicId, setPublicId] = useState(null);

    const {
        register,
        handleSubmit,
        control,
        setValue,
        formState: { errors },
    } = useForm();

    useEffect(() => {
        setPublicId(educBgData?.elementary?.public_id || null);

        setValue("name_of_school", educBgData?.elementary?.name_of_school || "");
        setValue("basic_education_degree_course", educBgData?.elementary?.basic_education_degree_course || "");
        setValue("from_date", educBgData?.elementary?.from_date || "");
        setValue("to_date", educBgData?.elementary?.to_date || "");
        setValue("highest_level_earned", educBgData?.elementary?.highest_level_earned || "");
        setValue("year_graduated", educBgData?.elementary?.year_graduated || "");
        setValue("scholarships_academic_honors",educBgData?.elementary?.scholarships_academic_honors || "");
    }, [educBgData]);

    function handleElementarySubmit(data, e) {
        e.preventDefault();
        const payload = {
            ...data,
            public_id: publicId,
            category: "elementary",
        };
        router.patch(route("educ-bg.update"), payload, {
            onSuccess: () => {
                setIsInputEditable(false);
            },
        });
    }

    return (
        <div className="ml-5">
            <EditSectionHeader
                header="Elementary"
                isInputEditable={isInputEditable}
                setIsInputEditable={setIsInputEditable}
                saveButton={true}
                onSave={handleSubmit(handleElementarySubmit)}
            />
            <div className="grid gap-4 mb-4 sm:grid-cols-3">
                <LabelInput
                    id={`name_of_school`}
                    label="Name of School"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={`basic_education_degree_course`}
                    label="Basic Education/Degree/Course"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <label className="my-2 text-sm space-y-2 text-black font-normal">
                    <span>Period of Attendance</span>
                    <div className="grid gap-4 sm:grid-cols-2">
                        <Controller
                            control={control}
                            name={`from_date`}
                            render={({ field }) => (
                                <CustomDatePicker
                                    value={field}
                                    error={errors}
                                    name="from_date"
                                    minimumDate="1950-01-01"
                                    maximumDate={dayjs().toString()}
                                    disabled={!isInputEditable}
                                />
                            )}
                        />
                        <Controller
                            control={control}
                            name={`to_date`}
                            render={({ field }) => (
                                <CustomDatePicker
                                    value={field}
                                    error={errors}
                                    name="to_date"
                                    minimumDate="1950-01-01"
                                    maximumDate={dayjs().toString()}
                                    disabled={!isInputEditable}
                                />
                            )}
                        />
                    </div>
                </label>
            </div>
            <div className="grid gap-4 mb-4 sm:grid-cols-3">
                <LabelInput
                    id={`highest_level_earned`}
                    label="Highest Level/Units Earned"
                    placeholder="Level"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={`year_graduated`}
                    label="Year Graduated"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={`scholarships_academic_honors`}
                    label="Scholarship/Academic Honors"
                    placeholder=""
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
            </div>
        </div>
    );
}

function Secondary({ educBgData }) {
    const [isInputEditable, setIsInputEditable] = useState(false);
    const [publicId, setPublicId] = useState(null);

    const {
        register,
        handleSubmit,
        control,
        setValue,
        formState: { errors },
    } = useForm();

    useEffect(() => {
        setPublicId(educBgData.secondary?.public_id || null);

        setValue("name_of_school", educBgData.secondary?.name_of_school || "");
        setValue("basic_education_degree_course", educBgData.secondary?.basic_education_degree_course || "");
        setValue("from_date", educBgData.secondary?.from_date || "");
        setValue("to_date", educBgData.secondary?.to_date || "");
        setValue("highest_level_earned", educBgData.secondary?.highest_level_earned || "");
        setValue("year_graduated", educBgData.secondary?.year_graduated || "");
        setValue("scholarships_academic_honors",educBgData.secondary?.scholarships_academic_honors || "");
    }, [educBgData]);

    function handleSecondarySubmit(data, e) {
        e.preventDefault();
        const payload = {
            ...data,
            public_id: publicId,
            category: "secondary",
        };
        router.patch(route("educ-bg.update"), payload, {
            onSuccess: () => {
                setIsInputEditable(false);
            },
        });
    }

    return (
        <div className="ml-5">
            <EditSectionHeader
                header="Secondary"
                isInputEditable={isInputEditable}
                setIsInputEditable={setIsInputEditable}
                saveButton={true}
                onSave={handleSubmit(handleSecondarySubmit)}
            />
            <div className="grid gap-4 mb-4 sm:grid-cols-3">
                <LabelInput
                    id={`name_of_school`}
                    label="Name of School"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={`basic_education_degree_course`}
                    label="Basic Education/Degree/Course"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <label className="my-2 text-sm space-y-2 text-black font-normal">
                    <span>Period of Attendance</span>
                    <div className="grid gap-4 sm:grid-cols-2">
                        <Controller
                            control={control}
                            name={`from_date`}
                            render={({ field }) => (
                                <CustomDatePicker
                                    value={field}
                                    error={errors}
                                    name="from_date"
                                    minimumDate="1950-01-01"
                                    maximumDate={dayjs().toString()}
                                    disabled={!isInputEditable}
                                />
                            )}
                        />
                        <Controller
                            control={control}
                            name={`to_date`}
                            render={({ field }) => (
                                <CustomDatePicker
                                    value={field}
                                    error={errors}
                                    name="to_date"
                                    minimumDate="1950-01-01"
                                    maximumDate={dayjs().toString()}
                                    disabled={!isInputEditable}
                                />
                            )}
                        />
                    </div>
                </label>
            </div>
            <div className="grid gap-4 mb-4 sm:grid-cols-3">
                <LabelInput
                    id={`highest_level_earned`}
                    label="Highest Level/Units Earned"
                    placeholder="Level"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={`year_graduated`}
                    label="Year Graduated"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={`scholarships_academic_honors`}
                    label="Scholarship/Academic Honors"
                    placeholder=""
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
            </div>
        </div>
    );
}

function Vocational({ educBgData }) {
    const [isInputEditable, setIsInputEditable] = useState(false);
    const [publicId, setPublicId] = useState(null);

    const {
        register,
        handleSubmit,
        control,
        setValue,
        formState: { errors },
    } = useForm();

    useEffect(() => {
        setPublicId(educBgData.vocational?.public_id || null);

        setValue("name_of_school", educBgData.vocational?.name_of_school || "");
        setValue("basic_education_degree_course", educBgData.vocational?.basic_education_degree_course || "");
        setValue("from_date", educBgData.vocational?.from_date || "");
        setValue("to_date", educBgData.vocational?.to_date || "");
        setValue("highest_level_earned", educBgData.vocational?.highest_level_earned || "");
        setValue("year_graduated", educBgData.vocational?.year_graduated || "");
        setValue("scholarships_academic_honors",educBgData.vocational?.scholarships_academic_honors || "");
    }, [educBgData]);

    function handleVocationalSubmit(data, e) {
        e.preventDefault();
        const payload = {
            ...data,
            public_id: publicId,
            category: "vocational",
        };
        router.patch(route("educ-bg.update"), payload, {
            onSuccess: () => {
                setIsInputEditable(false);
            },
        });
    }

    return (
        <div className="ml-5">
            <EditSectionHeader
                header="Vocational"
                isInputEditable={isInputEditable}
                setIsInputEditable={setIsInputEditable}
                saveButton={true}
                onSave={handleSubmit(handleVocationalSubmit)}
            />
            <div className="grid gap-4 mb-4 sm:grid-cols-3">
                <LabelInput
                    id={`name_of_school`}
                    label="Name of School"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={`basic_education_degree_course`}
                    label="Basic Education/Degree/Course"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <label className="my-2 text-sm space-y-2 text-black font-normal">
                    <span>Period of Attendance</span>
                    <div className="grid gap-4 sm:grid-cols-2">
                        <Controller
                            control={control}
                            name={`from_date`}
                            render={({ field }) => (
                                <CustomDatePicker
                                    value={field}
                                    error={errors}
                                    name="from_date"
                                    minimumDate="1950-01-01"
                                    maximumDate={dayjs().toString()}
                                    disabled={!isInputEditable}
                                />
                            )}
                        />
                        <Controller
                            control={control}
                            name={`to_date`}
                            render={({ field }) => (
                                <CustomDatePicker
                                    value={field}
                                    error={errors}
                                    name="to_date"
                                    minimumDate="1950-01-01"
                                    maximumDate={dayjs().toString()}
                                    disabled={!isInputEditable}
                                />
                            )}
                        />
                    </div>
                </label>
            </div>
            <div className="grid gap-4 mb-4 sm:grid-cols-3">
                <LabelInput
                    id={`highest_level_earned`}
                    label="Highest Level/Units Earned"
                    placeholder="Level"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={`year_graduated`}
                    label="Year Graduated"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={`scholarships_academic_honors`}
                    label="Scholarship/Academic Honors"
                    placeholder=""
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
            </div>
        </div>
    );
}

function College({ educBgData }) {
    const [isInputEditable, setIsInputEditable] = useState(false);
    const [publicId, setPublicId] = useState(null);

    const {
        register,
        handleSubmit,
        control,
        setValue,
        formState: { errors },
    } = useForm();

    useEffect(() => {
        setPublicId(educBgData.college?.public_id || null);

        setValue("name_of_school", educBgData.college?.name_of_school || "");
        setValue("basic_education_degree_course", educBgData.college?.basic_education_degree_course || "");
        setValue("from_date", educBgData.college?.from_date || "");
        setValue("to_date", educBgData.college?.to_date || "");
        setValue("highest_level_earned", educBgData.college?.highest_level_earned || "");
        setValue("year_graduated", educBgData.college?.year_graduated || "");
        setValue("scholarships_academic_honors",educBgData.college?.scholarships_academic_honors || "");
    }, [educBgData]);

    function handleCollegeSubmit(data, e) {
        e.preventDefault();
        const payload = {
            ...data,
            public_id: publicId,
            category: "college",
        };
        router.patch(route("educ-bg.update"), payload, {
            onSuccess: () => {
                setIsInputEditable(false);
            },
        });
    }

    return (
        <div className="ml-5">
            <EditSectionHeader
                header="College"
                isInputEditable={isInputEditable}
                setIsInputEditable={setIsInputEditable}
                saveButton={true}
                onSave={handleSubmit(handleCollegeSubmit)}
            />
            <div className="grid gap-4 mb-4 sm:grid-cols-3">
                <LabelInput
                    id={`name_of_school`}
                    label="Name of School"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={`basic_education_degree_course`}
                    label="Basic Education/Degree/Course"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <label className="my-2 text-sm space-y-2 text-black font-normal">
                    <span>Period of Attendance</span>
                    <div className="grid gap-4 sm:grid-cols-2">
                        <Controller
                            control={control}
                            name={`from_date`}
                            render={({ field }) => (
                                <CustomDatePicker
                                    value={field}
                                    error={errors}
                                    name="from_date"
                                    minimumDate="1950-01-01"
                                    maximumDate={dayjs().toString()}
                                    disabled={!isInputEditable}
                                />
                            )}
                        />
                        <Controller
                            control={control}
                            name={`to_date`}
                            render={({ field }) => (
                                <CustomDatePicker
                                    value={field}
                                    error={errors}
                                    name="to_date"
                                    minimumDate="1950-01-01"
                                    maximumDate={dayjs().toString()}
                                    disabled={!isInputEditable}
                                />
                            )}
                        />
                    </div>
                </label>
            </div>
            <div className="grid gap-4 mb-4 sm:grid-cols-3">
                <LabelInput
                    id={`highest_level_earned`}
                    label="Highest Level/Units Earned"
                    placeholder="Level"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={`year_graduated`}
                    label="Year Graduated"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={`scholarships_academic_honors`}
                    label="Scholarship/Academic Honors"
                    placeholder=""
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
            </div>
        </div>
    );
}

function Graduate({ educBgData }) {
    const [isInputEditable, setIsInputEditable] = useState(false);
    const [publicId, setPublicId] = useState(null);

    const {
        register,
        handleSubmit,
        control,
        setValue,
        formState: { errors },
    } = useForm();

    useEffect(() => {
        setPublicId(educBgData.graduate?.public_id || null);

        setValue("name_of_school", educBgData.graduate?.name_of_school || "");
        setValue("basic_education_degree_course", educBgData.graduate?.basic_education_degree_course || "");
        setValue("from_date", educBgData.graduate?.from_date || "");
        setValue("to_date", educBgData.graduate?.to_date || "");
        setValue("highest_level_earned", educBgData.graduate?.highest_level_earned || "");
        setValue("year_graduated", educBgData.graduate?.year_graduated || "");
        setValue("scholarships_academic_honors",educBgData.graduate?.scholarships_academic_honors || "");
    }, [educBgData]);

    function handleGraduateSubmit(data, e) {
        e.preventDefault();
        const payload = {
            ...data,
            public_id: publicId,
            category: "graduate",
        };
        router.patch(route("educ-bg.update"), payload, {
            onSuccess: () => {
                setIsInputEditable(false);
            },
        });
    }

    return (
        <div className="ml-5">
            <EditSectionHeader
                header="Graduate"
                isInputEditable={isInputEditable}
                setIsInputEditable={setIsInputEditable}
                saveButton={true}
                onSave={handleSubmit(handleGraduateSubmit)}
            />
            <div className="grid gap-4 mb-4 sm:grid-cols-3">
                <LabelInput
                    id={`name_of_school`}
                    label="Name of School"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={`basic_education_degree_course`}
                    label="Basic Education/Degree/Course"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <label className="my-2 text-sm space-y-2 text-black font-normal">
                    <span>Period of Attendance</span>
                    <div className="grid gap-4 sm:grid-cols-2">
                        <Controller
                            control={control}
                            name={`from_date`}
                            render={({ field }) => (
                                <CustomDatePicker
                                    value={field}
                                    error={errors}
                                    name="from_date"
                                    minimumDate="1950-01-01"
                                    maximumDate={dayjs().toString()}
                                    disabled={!isInputEditable}
                                />
                            )}
                        />
                        <Controller
                            control={control}
                            name={`to_date`}
                            render={({ field }) => (
                                <CustomDatePicker
                                    value={field}
                                    error={errors}
                                    name="to_date"
                                    minimumDate="1950-01-01"
                                    maximumDate={dayjs().toString()}
                                    disabled={!isInputEditable}
                                />
                            )}
                        />
                    </div>
                </label>
            </div>
            <div className="grid gap-4 mb-4 sm:grid-cols-3">
                <LabelInput
                    id={`highest_level_earned`}
                    label="Highest Level/Units Earned"
                    placeholder="Level"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={`year_graduated`}
                    label="Year Graduated"
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
                <LabelInput
                    id={`scholarships_academic_honors`}
                    label="Scholarship/Academic Honors"
                    placeholder=""
                    register={register}
                    error={errors}
                    disabled={!isInputEditable}
                />
            </div>
        </div>
    );
}