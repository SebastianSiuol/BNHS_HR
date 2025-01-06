import { useState, useEffect } from "react";
import { useForm, Controller } from "react-hook-form";
import { usePage, router } from "@inertiajs/react";
import { z } from "zod";

import CustomDatePicker from "@/Components/CustomDatePicker";
import { LabelInput } from "@/Components/LabelInput";
import { InputSelect } from "@/Components/InputSelect";

export function LearningAndDevelopment() {
    const { handleSubmit, control, register } = useForm();

    const onSubmit = (data) => {
        console.log("Form Data:", data);
    };

    return (
        <div className=" bg-white shadow p-6 rounded-lg">
            <div className="flex justify-between items-center border-b pb-4 mb-4">
                <h2 className="text-lg font-bold text-gray-800">
                    Learning and Development
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
                                        rowSpan="2">
                                        TITLE OF LEARNING AND DEVELOPMENT
                                        INTERVENTIONS/TRAINING PROGRAMS
                                        <br />
                                        (Write in full)
                                    </th>
                                    <th
                                        className="border px-4 py-2"
                                        colSpan="2">
                                        INCLUSIVE DATES OF ATTENDANCE
                                    </th>
                                    <th
                                        className="border px-4 py-2"
                                        rowSpan="2">
                                        NUMBER OF HOURS
                                    </th>
                                    <th
                                        className="border px-4 py-2"
                                        rowSpan="2">
                                        Type of LD (Managerial/ Supervisory/
                                        Technical/etc)
                                    </th>
                                    <th
                                        className="border px-4 py-2"
                                        rowSpan="2">
                                        CONDUCTED/ SPONSORED BY
                                        <br />
                                        (Write in full)
                                    </th>
                                </tr>
                                <tr>
                                    <th className="border px-4 py-2">From</th>
                                    <th className="border px-4 py-2">To</th>
                                </tr>
                            </thead>
                            <tbody>
                                {Array.from({ length: 10 }).map((_, index) => (
                                    <tr key={index}>
                                        <td className="border px-4 py-2">
                                            <input
                                                {...register(`title${index}`)}
                                                type="text"
                                                className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                placeholder=""
                                            />
                                        </td>
                                        <td className="border px-4 py-2">
                                            <Controller
                                                control={control}
                                                name={`fromDate${index}`}
                                                render={({ field }) => (
                                                    <input
                                                        {...field}
                                                        type="date"
                                                        className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                    />
                                                )}
                                            />
                                        </td>
                                        <td className="border px-4 py-2">
                                            <Controller
                                                control={control}
                                                name={`toDate${index}`}
                                                render={({ field }) => (
                                                    <input
                                                        {...field}
                                                        type="date"
                                                        className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                    />
                                                )}
                                            />
                                        </td>
                                        <td className="border px-4 py-2">
                                            <input
                                                {...register(`hours${index}`)}
                                                type="number"
                                                className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                placeholder=""
                                            />
                                        </td>
                                        <td className="border px-4 py-2">
                                            <input
                                                {...register(`type${index}`)}
                                                type="text"
                                                className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                placeholder=""
                                            />
                                        </td>
                                        <td className="border px-4 py-2">
                                            <input
                                                {...register(
                                                    `sponsoredBy${index}`
                                                )}
                                                type="text"
                                                className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                placeholder=""
                                            />
                                        </td>
                                    </tr>
                                ))}
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
