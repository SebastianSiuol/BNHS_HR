// React Hook Form

import React from "react";

export function InputSelect({ id, register, error, children }) {
    return (<>
        <select {...register(`${id}`)} id={id}
            className={"w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-blue-600 focus:border-blue-600"}>
            {children}
        </select>
                    {error && (
                        <div className="flex justify-end">
                            <p className="text-red-500 text-sm italic">{error[id]?.message}</p>
                        </div>
                    )}
    </>);
}
