import { useState, useEffect } from "react";
import { useForm, Controller } from "react-hook-form";
import { usePage, router } from "@inertiajs/react";
import { z } from "zod";

import CustomDatePicker from "@/Components/CustomDatePicker";
import { LabelInput } from "@/Components/LabelInput";
import { InputSelect } from "@/Components/InputSelect";

export function WorkExperience() {
    const {
        register,
        handleSubmit,
        formState: { errors },
        reset,
        control,
    } = useForm();

    const onSubmit = (data) => {
        console.log(data);
    };

    return (
        <div className="bg-white shadow p-6 rounded-lg">
            <div className="flex justify-between items-center border-b pb-4 mb-4">
                <h2 className="text-lg font-bold text-gray-800">
                    Work Experience
                </h2>
                <button className="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600">
                    Edit
                </button>
            </div>
            <div className="space-y-4">
                <form onSubmit={handleSubmit(onSubmit)}>
                    <div className="container overflow-x-auto mx-auto">
                        <table className="min-w-full border-collapse border border-gray-300 text-sm text-left">
                            <thead className="bg-gray-50 text-center">
                                <tr>
                                    <th
                                        className="border px-4 py-2"
                                        colSpan="2">
                                        INCLUSIVE DATES
                                    </th>
                                    <th
                                        className="border px-4 py-2"
                                        rowSpan="2">
                                        POSITION TITLE <br /> (Write in full/Do
                                        not abbreviate)
                                    </th>
                                    <th
                                        className="border px-4 py-2"
                                        rowSpan="2">
                                        DEPARTMENT / AGENCY / OFFICE / COMPANY{" "}
                                        <br /> (Write in full/Do not abbreviate)
                                    </th>
                                    <th
                                        className="border px-4 py-2"
                                        rowSpan="2">
                                        MONTHLY SALARY
                                    </th>
                                    <th
                                        className="border px-4 py-2"
                                        rowSpan="2">
                                        SALARY/ JOB/ PAY GRADE <br /> (if
                                        applicable) & STEP (Format "00-0")/
                                        INCREMENT
                                    </th>
                                    <th
                                        className="border px-4 py-2"
                                        rowSpan="2">
                                        STATUS OF APPOINTMENT
                                    </th>
                                    <th
                                        className="border px-4 py-2"
                                        rowSpan="2">
                                        GOV'T SERVICE <br /> (Y/ N)
                                    </th>
                                </tr>
                                <tr>
                                    <th className="border px-4 py-2">From</th>
                                    <th className="border px-4 py-2">To</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td className="border px-4 py-2">
                                        <Controller
                                            control={control}
                                            name="from_date"
                                            render={({ field }) => (
                                                <CustomDatePicker
                                                    value={field}
                                                    error={errors}
                                                    name="from_date"
                                                />
                                            )}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <Controller
                                            control={control}
                                            name="to_date"
                                            render={({ field }) => (
                                                <CustomDatePicker
                                                    value={field}
                                                    error={errors}
                                                    name="to_date"
                                                />
                                            )}
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            {...register("position_title")}
                                            type="text"
                                            pattern="[A-Za-z\s]+"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder=""
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            {...register("department")}
                                            type="text"
                                            pattern="[A-Za-z\s]+"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder=""
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            {...register("monthly_salary")}
                                            type="number"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder=""
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            {...register("salary_grade")}
                                            type="text"
                                            pattern="[A-Za-z\s]+"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder=""
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <input
                                            {...register(
                                                "status_of_appointment"
                                            )}
                                            type="text"
                                            pattern="[A-Za-z\s]+"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            placeholder=""
                                        />
                                    </td>
                                    <td className="border px-4 py-2">
                                        <select
                                            {...register("gov_service")}
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            <option
                                                selected
                                                disabled>
                                                Select
                                            </option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {/* Save Button */}
                    <div className="mt-6 flex justify-end">
                        <button
                            type="submit"
                            className="bg-green-500 text-white px-6 py-2 rounded-lg shadow hover:bg-green-600">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    );
}
