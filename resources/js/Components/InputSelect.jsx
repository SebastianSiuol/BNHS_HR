import React from "react";

function mergedClass(...classes) {
  return classes.filter(Boolean).join(" ");
}

export function InputSelect({ id, register, error, disabled = false, children, ...props }) {

  const selectClass = 'w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-blue-600 focus:border-blue-600 ';

  return (
    <>
      <select
        {...register(id)}
        id={id}
        disabled={disabled}
        className={mergedClass(selectClass, error?.[id] && " border-red-500 ", disabled && " bg-gray-500/20 cursor-not-allowed ")}
        {...props}
      >
        {children}
      </select>
      {error && (
        <div className="flex">
          <p className="text-red-500 text-sm italic">{error[id]?.message}</p>
        </div>
      )}
    </>
  );
}