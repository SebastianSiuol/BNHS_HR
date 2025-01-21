import { useState } from "react";

export function EditSectionHeader({
    header,
    isInputEditable,
    setIsInputEditable,
    addButton = false,
    onAdd = {},
    saveButton = false,
    onSave = {},
}) {
    return (
        <div className="flex justify-between items-center pb-4 mb-4">
            <div>
                {isInputEditable && (
                    <h1 className="text-yellow-600 font-bold">Now Editing</h1>
                )}
                <h2 className="text-lg font-bold text-gray-800">{header}</h2>
            </div>
            <div className="space-x-4">
                <button
                    onClick={() => setIsInputEditable(!isInputEditable)}
                    className="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600">
                    {isInputEditable ? "Cancel Edit" : "Edit"}
                </button>
                {addButton && isInputEditable && (
                    <button
                        onClick={onAdd}
                        className="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600">
                            Add
                        </button>
                )}
                {saveButton && isInputEditable && (
                    <button
                        onClick={onSave}
                        className="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600">
                            Save
                    </button>
                )}
            </div>
        </div>
    );
}
