import { useState, useEffect } from "react";
import { useForm, Controller } from "react-hook-form";
import { usePage, router } from "@inertiajs/react";
import { z } from "zod";

import CustomDatePicker from "@/Components/CustomDatePicker";
import { LabelInput } from "@/Components/LabelInput";
import { InputSelect } from "@/Components/InputSelect";

export function VoluntaryWork(){
    const {
      register,
      handleSubmit,
      formState: { errors },
    } = useForm();

    const onSubmit = (data) => {
      console.log(data);
    };

    return (
      <div className="bg-white shadow p-6 rounded-lg">
        <div className="flex justify-between items-center border-b pb-4 mb-4">
          <h2 className="text-lg font-bold text-gray-800">Voluntary Work</h2>
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
                    <th className="border px-4 py-2" rowSpan="2">
                      NAME & ADDRESS OF ORGANIZATION <br />(Write in full)
                    </th>
                    <th className="border px-4 py-2" colSpan="2">
                      INCLUSIVE DATES
                    </th>
                    <th className="border px-4 py-2" rowSpan="2">
                      NUMBER OF HOURS
                    </th>
                    <th className="border px-4 py-2" rowSpan="2">
                      POSITION / NATURE OF WORK
                    </th>
                  </tr>
                  <tr>
                    <th className="border px-4 py-2">From</th>
                    <th className="border px-4 py-2">To</th>
                  </tr>
                </thead>
                <tbody>
                  {[1, 2, 3].map((row) => (
                    <tr key={row}>
                      <td className="border px-4 py-2">
                        <input
                          type="text"
                          {...register(`organization${row}`, { required: true })}
                          className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                          placeholder="Organization Name"
                        />
                        {errors[`organization${row}`] && (
                          <span className="text-red-600 text-xs">This field is required</span>
                        )}
                      </td>
                      <td className="border px-4 py-2">
                        <input
                          type="date"
                          {...register(`fromDate${row}`, { required: true })}
                          className="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                        />
                        {errors[`fromDate${row}`] && (
                          <span className="text-red-600 text-xs">This field is required</span>
                        )}
                      </td>
                      <td className="border px-4 py-2">
                        <input
                          type="date"
                          {...register(`toDate${row}`, { required: true })}
                          className="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                        />
                        {errors[`toDate${row}`] && (
                          <span className="text-red-600 text-xs">This field is required</span>
                        )}
                      </td>
                      <td className="border px-4 py-2">
                        <input
                          type="number"
                          {...register(`hours${row}`, { required: true, min: 1 })}
                          className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                          placeholder="Hours"
                        />
                        {errors[`hours${row}`] && (
                          <span className="text-red-600 text-xs">Valid hours are required</span>
                        )}
                      </td>
                      <td className="border px-4 py-2">
                        <input
                          type="text"
                          {...register(`position${row}`, { required: true })}
                          className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                          placeholder="Position/Nature of Work"
                        />
                        {errors[`position${row}`] && (
                          <span className="text-red-600 text-xs">This field is required</span>
                        )}
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>

            <div className="mt-6 flex justify-end">
              <button
                type="submit"
                className="bg-green-500 text-white px-6 py-2 rounded-lg shadow hover:bg-green-600"
              >
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    );
  };