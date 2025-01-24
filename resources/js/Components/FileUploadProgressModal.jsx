import React from "react";

export default function FileUploadProgressModal({ isOpen, progress }) {
    if (!isOpen) return null;

    return (
        <div className="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
            <div className="bg-white p-4 rounded-lg shadow-lg w-96">
                <h3 className="text-lg font-semibold text-gray-900 mb-2">
                    Uploading File...
                </h3>
                <div className="w-full bg-gray-200 rounded-full h-4">
                    <div
                        className="bg-blue-600 h-4 rounded-full"
                        style={{ width: `${progress}%` }}
                    ></div>
                </div>
                <p className="text-center mt-2 text-sm text-gray-600">
                    {progress}% completed
                </p>
            </div>
        </div>
    );
}
