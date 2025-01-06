import { useState, useEffect } from "react";
import { useForm, Controller } from "react-hook-form";
import { usePage, router } from "@inertiajs/react";
import { z } from "zod";

import CustomDatePicker from "@/Components/CustomDatePicker";
import { LabelInput } from "@/Components/LabelInput";
import { InputSelect } from "@/Components/InputSelect";

export function EducationalBackground() {
    const [inputEditable, setInputEditable] = useState(false);

    const {
        register,
        handleSubmit,
        formState: { errors },
        reset,
        control,
    } = useForm();

    return (
        <div className=" bg-white shadow p-6 rounded-lg">
            <div className="flex justify-between items-center border-b pb-4 mb-4">
                <div>
                    {inputEditable && <h1 className={"text-yellow-600 font-bold"}>Now Editing</h1>}
                    <h2 className="text-lg font-bold text-gray-800">Educational Background</h2>
                </div>

                <button
                    onClick={() => {
                        setInputEditable((e) => !e);
                    }}
                    className="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600"
                >
                    Edit
                </button>
            </div>
            <div class="space-y-4">
                <h2 class="text-lg font-medium mb-3">Elementary</h2>

                <div class="ml-5">
                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                        <LabelInput
                            id={"elem_name"}
                            label={"Name of School"}
                            register={register}
                            error={errors}
                        />
                        <LabelInput
                            id={"elem_basic_educ_degree_course"}
                            label={"Basic Education/Degree/Course"}
                            register={register}
                            error={errors}
                        />

                        <label class="my-2 text-sm space-y-2 text-black font-normal">
                            <span>Period of Attendance</span>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <input
                                    {...register("elem_from")}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="From"
                                />
                                <input
                                    {...register("elem_to")}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="To"
                                />
                            </div>
                        </label>
                    </div>

                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                        <LabelInput
                            id={"elem_highest_leve"}
                            label={"Highest Level/ Units Earned"}
                            placeholder={"Level"}
                            register={register}
                            error={errors}
                        />
                        <LabelInput
                            id={"elem_year_graduated"}
                            label={"Year Graduated"}
                            register={register}
                            error={errors}
                        />
                        <LabelInput
                            id={"elem_scholarship"}
                            label={"Scholarship/Academic Honors"}
                            placeholder={""}
                            register={register}
                            error={errors}
                        />
                    </div>
                </div>

                <h2 class="text-lg font-medium mb-3">Secondary</h2>

                <div class="ml-5">
                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                        <LabelInput
                            id={"secondary_name"}
                            label={"Name of School"}
                            register={register}
                            error={errors}
                        />
                        <LabelInput
                            id={"secondary_basic_educ_degree_course"}
                            label={"Basic Education/Degree/Course"}
                            register={register}
                            error={errors}
                        />

                        <label class="my-2 text-sm space-y-2 text-black font-normal">
                            <span>Period of Attendance</span>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <input
                                    {...register("secondary_from")}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="From"
                                />
                                <input
                                    {...register("secondary_to")}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="To"
                                />
                            </div>
                        </label>
                    </div>

                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                        <LabelInput
                            id={"secondary_highest_leve"}
                            label={"Highest Level/ Units Earned"}
                            placeholder={"Level"}
                            register={register}
                            error={errors}
                        />
                        <LabelInput
                            id={"secondary_year_graduated"}
                            label={"Year Graduated"}
                            register={register}
                            error={errors}
                        />
                        <LabelInput
                            id={"secondary_scholarship"}
                            label={"Scholarship/Academic Honors"}
                            placeholder={""}
                            register={register}
                            error={errors}
                        />
                    </div>
                </div>

                <h2 class="text-lg font-medium mb-3">
                    Vocational / Trade Course
                </h2>

                <div class="ml-5">
                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                        <LabelInput
                            id={"vocational_name"}
                            label={"Name of School"}
                            register={register}
                            error={errors}
                        />
                        <LabelInput
                            id={"vocational_basic_educ_degree_course"}
                            label={"Basic Education/Degree/Course"}
                            register={register}
                            error={errors}
                        />

                        <label class="my-2 text-sm space-y-2 text-black font-normal">
                            <span>Period of Attendance</span>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <input
                                    {...register("vocational_from")}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="From"
                                />
                                <input
                                    {...register("vocational_to")}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="To"
                                />
                            </div>
                        </label>
                    </div>

                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                        <LabelInput
                            id={"vocational_highest_leve"}
                            label={"Highest Level/ Units Earned"}
                            placeholder={"Level"}
                            register={register}
                            error={errors}
                        />
                        <LabelInput
                            id={"vocational_year_graduated"}
                            label={"Year Graduated"}
                            register={register}
                            error={errors}
                        />
                        <LabelInput
                            id={"vocational_scholarship"}
                            label={"Scholarship/Academic Honors"}
                            placeholder={""}
                            register={register}
                            error={errors}
                        />
                    </div>
                </div>

                <h2 class="text-lg font-medium mb-3">College</h2>

                <div class="ml-5">
                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                        <LabelInput
                            id={"college_name"}
                            label={"Name of School"}
                            register={register}
                            error={errors}
                        />
                        <LabelInput
                            id={"college_basic_educ_degree_course"}
                            label={"Basic Education/Degree/Course"}
                            register={register}
                            error={errors}
                        />

                        <label class="my-2 text-sm space-y-2 text-black font-normal">
                            <span>Period of Attendance</span>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <input
                                    {...register("college_from")}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="From"
                                />
                                <input
                                    {...register("college_to")}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="To"
                                />
                            </div>
                        </label>
                    </div>

                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                        <LabelInput
                            id={"college_highest_leve"}
                            label={"Highest Level/ Units Earned"}
                            placeholder={"Level"}
                            register={register}
                            error={errors}
                        />
                        <LabelInput
                            id={"college_year_graduated"}
                            label={"Year Graduated"}
                            register={register}
                            error={errors}
                        />
                        <LabelInput
                            id={"college_scholarship"}
                            label={"Scholarship/Academic Honors"}
                            placeholder={""}
                            register={register}
                            error={errors}
                        />
                    </div>
                </div>

                <h2 class="text-lg font-medium mb-3">Graduate Studies</h2>

                <div class="ml-5">
                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                        <LabelInput
                            id={"graduate_name"}
                            label={"Name of School"}
                            register={register}
                            error={errors}
                        />
                        <LabelInput
                            id={"graduate_basic_educ_degree_course"}
                            label={"Basic Education/Degree/Course"}
                            register={register}
                            error={errors}
                        />

                        <label class="my-2 text-sm space-y-2 text-black font-normal">
                            <span>Period of Attendance</span>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <input
                                    {...register("graduate_from")}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="From"
                                />
                                <input
                                    {...register("graduate_to")}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="To"
                                />
                            </div>
                        </label>
                    </div>

                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                        <LabelInput
                            id={"graduate_highest_leve"}
                            label={"Highest Level/ Units Earned"}
                            placeholder={"Level"}
                            register={register}
                            error={errors}
                        />
                        <LabelInput
                            id={"graduate_year_graduated"}
                            label={"Year Graduated"}
                            register={register}
                            error={errors}
                        />
                        <LabelInput
                            id={"graduate_scholarship"}
                            label={"Scholarship/Academic Honors"}
                            placeholder={""}
                            register={register}
                            error={errors}
                        />
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        type="submit"
                        class="bg-green-500 text-white px-6 py-2 rounded-lg shadow hover:bg-green-600">
                        Save
                    </button>
                </div>
            </div>
        </div>
    );
}
