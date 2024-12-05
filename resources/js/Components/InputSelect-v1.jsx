import React from "react";

export function InputSelect({ id, value, onChange, children }) {
    return (
        <select
            id={id}
            value={value}
            onChange={onChange}
            className={
                "w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-blue-600 focus:border-blue-600"
            }
        >
            {children}
        </select>
    );
}
