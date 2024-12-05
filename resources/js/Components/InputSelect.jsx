// React Hook Form

import React from "react";

export function InputSelect({ id, register, children }) {
    return (
        <select
            id={id}
            {...register(`${id}`)}
            className={
                "w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-blue-600 focus:border-blue-600"
            }
        >
            {children}
        </select>
    );
}
