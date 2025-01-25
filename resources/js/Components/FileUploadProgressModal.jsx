import React from "react";
import Modal from "@/Components/Modal.jsx";
import { Description, DialogTitle } from "@headlessui/react";

export default function FileUploadProgressModal({ isOpen, progress }) {
    if (!isOpen) return null;

    function doNothing(){
        console.log('File Uploading!')
    }

    return (
        <Modal state={isOpen} onToggle={doNothing}>
            <DialogTitle as={"div"} className={'p-6 pb-1 w-[50vw]'}>
                <h3 className="text-lg font-semibold text-gray-900 mb-2">
                    Uploading File...
                </h3>
            </DialogTitle>
            <Description as={"div"} className="px-6 pb-2 space-y-2 w-[50vw]">
                <div className="w-full bg-gray-200 rounded-full h-4">
                    <div
                        className="bg-blue-600 h-4 rounded-full"
                        style={{ width: `${progress}%` }}
                    ></div>
                </div>
                <p className="text-center mt-2 text-sm text-gray-600">
                    {progress}% completed
                </p>
            </Description>
        </Modal>
    );
}
