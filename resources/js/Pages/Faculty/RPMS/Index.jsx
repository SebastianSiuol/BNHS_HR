import { useState, useEffect } from "react";
import { usePage, router } from "@inertiajs/react";
import { Description, DialogTitle } from "@headlessui/react";
import { useForm, Controller } from "react-hook-form";

import { FaPlus } from "react-icons/fa";
import { IoSearchSharp, IoDocumentTextOutline } from "react-icons/io5";

import Pagination from "@/Components/Pagination";
import Modal from "@/Components/Modal";
import CustomIcon from "@/Components/CustomIcon";
import { FileInput } from "@/Components/FileInput";
import { ContentContainer } from "@/Components/ContentContainer";
import { ContentHeader } from "@/Components/ContentHeader";
import { Table, TableRow } from "@/Components/Table";

import { handleStatus, handleUploadPeriod } from "@/Utils/formatTableDataUtils";
import { capitalizeFirstLetter } from "@/Utils/stringUtils";
import { formatDate } from "@/Utils/customDayjsUtils";

export default function Index() {
    return (
        <>
            <ContentContainer>
                <ContentHeader> Performance Management</ContentHeader>
                <HandlePage />
            </ContentContainer>
        </>
    );
}

function HandlePage() {
    const { rpms } = usePage().props;
    const [currentFilePath, setCurrentFilePath] = useState(null);
    const [openUploadModal, setOpenUploadModal] = useState(false);
    const [openViewFileModal, setOpenViewFileModal] = useState(false);
    const [openDelFileModal, setOpenDelFileModal] = useState(false);
    const [selectedFile, setSelectedFile] = useState(null)

    function handleUploadModal() {
        setOpenUploadModal((e) => !e);
    }

    function handleViewDocument(id) {
        setSelectedFile(id);
        setOpenViewFileModal((e) => !e);
    }

    function handleDeleteDocument(id){

        setSelectedFile(id);
        setOpenDelFileModal((e) => !e);
    }

    async function handleDownloadDocument(id) {
        try {
            // Perform validation
            if (!id) {
                throw new Error("Invalid document ID.");
            }

            // Make the API call to fetch the file
            const response = await fetch(route("faculty.rpms.file.download", id), {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                },
            });

            console.log(response);

            // Check if the response is successful
            if (!response.ok) {
                const errorMessage = await response.text();
                throw new Error(
                    `Failed to download file: ${response.status} ${response.statusText}. ${errorMessage}`
                );
            }

            // Handle the file download
            const blob = await response.blob();
            const href = window.URL.createObjectURL(blob);
            const link = document.createElement("a");
            link.href = href;

            // Extract filename from the response headers if available
            const contentDisposition = response.headers.get("Content-Disposition");
            const fileName = contentDisposition
                ? contentDisposition.split("filename=")[1]?.replace(/"/g, "") || "downloaded-file"
                : "downloaded-file";

            link.setAttribute("download", fileName.trim());
            document.body.appendChild(link);
            link.click();

            // Cleanup
            document.body.removeChild(link);
            window.URL.revokeObjectURL(href);
        } catch (err) {
            console.error("Error:", err);
            // Optionally provide user feedback
            alert(`Failed to download the document. Error: ${err.message}`);
            return Promise.reject(err);
        }
    }


    return (
        <>
            <SearchHeaders onUploadModal={handleUploadModal} />
            <RPMSTable data={rpms?.data} onViewFile={handleViewDocument} onDeleteFile={handleDeleteDocument} onDownloadFile={handleDownloadDocument}/>
            <Pagination data={rpms} />
            <UploadModal
                state={openUploadModal}
                onToggle={handleUploadModal}
            />
            <ViewDocumentModal
                state={openViewFileModal}
                onToggle={handleViewDocument}
                selectedFile={selectedFile}
            />
            <DeleteDocumentModal
                state={openDelFileModal}
                onToggle={handleDeleteDocument}
                selectedFile={selectedFile}
            />
        </>
    );
}

function SearchHeaders({ onUploadModal }) {
    const { rpmsConfig, searchQuery } = usePage().props;
    const [query, setQuery] = useState(searchQuery);

    // Render a message if rpmsConfig is not set
    if (!rpmsConfig) {
        return (
            <div className="pb-4 sm:flex items-center justify-between">
                Configuration for Uploading is not yet set, please wait for
                admin.
            </div>
        );
    }

    const { mid_year_date: midYearDate, end_year_date: endYearDate } =
        rpmsConfig;

    function handleSearchQuery(e){
        e.preventDefault()
        const payload = {
            'query': query,
        };
        router.get(route('faculty.rpms.search'), payload)
    }

    return (
        <div className="pb-4 sm:flex items-center justify-between">
            {/* Search Input */}
            <form className="relative flex mt-1">
                <label
                    htmlFor="tableSearch"
                    className="relative">
                    <div className="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <IoSearchSharp className={"w-4 h-4 text-gray-500"} />
                    </div>
                    <input
                        id="tableSearch"
                        type="text"
                        placeholder="Search"
                        value={query}
                        onChange={(e)=>setQuery(e.target.value)}
                        className="block mr-2 h-10 sm:w-96 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    />
                </label>
                <button
                    type="submit"
                    onClick={handleSearchQuery}
                    className="ml-2 px-3 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-300">
                    Search
                </button>
            </form>

            {/* Submission Date */}
            <div className="flex border-gray-300 mt-1 px-4 border bg-gray-50 rounded-lg items-center justify-center">
                <div className="mr-4">
                    <h1 className="text-sm">Submission Date:</h1>
                </div>
                <div>
                    <h1 className="text-sm">Mid Year | Year End</h1>
                    <div className="flex">
                        <p className="text-sm mr-2">{midYearDate}</p>
                        <p className="text-sm">{endYearDate}</p>
                    </div>
                </div>
            </div>

            {/* Upload File Button */}
            <button
                type="button"
                onClick={onUploadModal}
                className="text-white mt-3 flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2">
                <FaPlus className="mr-1 w-4 h-4 text-white" />
                Upload File
            </button>
        </div>
    );
}

function RPMSTable({ data, onViewFile, onDeleteFile, onDownloadFile }) {
    const headers = ["Date Submitted", "File Name", "File", "Period", "Status", "Action"];

    const columns = [
        (rpms) => formatDate(rpms.created_at),
        (rpms) => rpms.filename,
        (rpms) => (
            <button onClick={() => onViewFile(rpms.id)}>
                <CustomIcon type="view" />
            </button>
        ),
        (rpms) => handleUploadPeriod(rpms.upload_period),
        (rpms) => handleStatus(capitalizeFirstLetter(rpms?.status)),
        (rpms) => (
            <div className="flex space-x-4">
                <button onClick={()=>onDownloadFile(rpms.id)}>
                    <CustomIcon type="download" />
                </button>
                <button onClick={() => onDeleteFile(rpms.id)}>
                    <CustomIcon type="delete" />
                </button>
            </div>
        ),
    ];

    return (
        <Table
            data={data}
            headers={headers}
            renderRow={(rpms) => (
                <TableRow
                    key={rpms.id}
                    data={rpms}
                    columns={columns}
                />
            )}
        />
    );
}

function UploadModal({ state, onToggle }) {
    const { uploadPeriod } = usePage().props;
    const {
        handleSubmit,
        control,
        formState: { errors },
    } = useForm();

    const onSubmit = (data) => {
        router.post(route("faculty.rpms.store"), data, {
            onSuccess: ()=>{
                onToggle();
            }
        });
    };


    function handleUploadPeriod(data) {
        switch (data.toString().toLowerCase()) {
            case "mid_year":
                return "Mid Year";
            case "end_year":
                return "End Year";
        }
    }

    return (
        <Modal
            state={state}
            onToggle={onToggle}>
            <DialogTitle className="flex font-bold text-2xl text-gray-900 justify-between items-center p-4">
                <span>Upload Document</span>
                <button
                    onClick={onToggle}
                    className="text-red-800">
                    &times;
                </button>
            </DialogTitle>
            <Description as="div">
                <hr />
                <div className="relative overflow-x-auto shadow-md sm:rounded-lg mr-5">
                    <div className="items-center justify-center flex mb-5">
                        <h1 className="text-lg">{`Upload document for ${handleUploadPeriod(uploadPeriod)}`}</h1>
                    </div>

                    <div className="py-5 px-5">
                        <form onSubmit={handleSubmit(onSubmit)}>
                            <div className="w-full py-9 bg-gray-50 rounded-2xl border border-gray-300 gap-3 grid border-dashed">
                                <div className="grid gap-1">
                                    <IoDocumentTextOutline className="mx-auto w-[40px] h-[40px] text-violet-500" />
                                    <h2 className="text-center text-gray-400 text-xs leading-4">
                                        PDF file only! maximum of 5MB
                                    </h2>
                                </div>
                                <div className="grid gap-4">
                                    {/* Main File Input */}
                                    <div className="flex px-3 items-center justify-center">
                                        <Controller
                                            name="mainFile"
                                            control={control}
                                            rules={{
                                                required:
                                                    "Main file is required.",
                                                validate: (file) =>
                                                    file?.size <=
                                                        5 * 1024 * 1024 ||
                                                    "File size exceeds 5MB",
                                            }}
                                            render={({ field }) => (
                                                <FileInput
                                                    file={field.value}
                                                    onFileChange={(file) =>
                                                        field.onChange(file)
                                                    }
                                                />
                                            )}
                                        />
                                    </div>
                                    {errors.mainFile && (
                                        <p className="text-red-500 text-sm mt-1 text-center">
                                            {errors.mainFile.message}
                                        </p>
                                    )}

                                    {/* Additional Files */}
                                    <label className="block text-center text-sm font-medium text-gray-900">
                                        Additional Files (Optional)
                                    </label>
                                    <div className="flex flex-col gap-y-4  px-3">
                                        {[0, 1].map((index) => (
                                            <Controller
                                                key={index}
                                                name={`additionalFiles.${index}`}
                                                control={control}
                                                rules={{
                                                    validate: (file) =>
                                                        !file ||
                                                        file?.size <=
                                                            5 * 1024 * 1024 ||
                                                        "File size exceeds 5MB",
                                                }}
                                                render={({ field }) => (
                                                    <FileInput
                                                        file={field.value}
                                                        onFileChange={(file) =>
                                                            field.onChange(file)
                                                        }
                                                        label="Browse..."
                                                        placeholder="No File Selected"
                                                    />
                                                )}
                                            />
                                        ))}
                                    </div>
                                    {errors.additionalFiles?.map(
                                        (error, index) =>
                                            error && (
                                                <p
                                                    key={index}
                                                    className="text-red-500 text-sm mt-1 text-center">
                                                    {error.message}
                                                </p>
                                            )
                                    )}
                                </div>
                            </div>

                            <div className="mt-8 flex items-center justify-center">
                                <button
                                    type="submit"
                                    className="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </Description>
        </Modal>
    );
}

function ViewDocumentModal({ state, onToggle, selectedFile }) {
    const [fileUrl, setFileUrl] = useState(null);


    useEffect(() => {
        async function getUrl() {
            if (selectedFile) {
                const response = await fetch(
                    route("faculty.rpms.file.view", selectedFile)
                );
                const parsedResponse = await response.json();

                setFileUrl(parsedResponse);
            }
        }
        getUrl();
    }, [selectedFile]);


    return (
        <Modal
            state={state}
            onToggle={onToggle}>
            <DialogTitle className="flex font-bold text-2xl text-gray-900 justify-between items-center p-4">
                <span>View File</span>
                <button
                    onClick={onToggle}
                    className="text-red-800">
                    &times;
                </button>
            </DialogTitle>
            <Description as="div" className={'w-[80vw]'}>
                <hr />
                {/* <p>{fileUrl}</p> */}
                <iframe
                    src={fileUrl?.pdfUrl}
                    width="100%"
                    height={"600px"}></iframe>
            </Description>
        </Modal>
    );
}

function DeleteDocumentModal({ state, onToggle, selectedFile }) {
    function handleDelete() {
        console.log(selectedFile.id);
        router.delete(route("faculty.rpms.delete", selectedFile), {
            onSuccess: () => {
                onToggle();
            },
        });
    }

    return (
        <Modal
            state={state}
            onToggle={onToggle}>
            <DialogTitle
                className="flex font-bold text-2xl text-black justify-between items-center p-4"
                as="div">
                <span>
                    Confirm{" "}
                    <span className={"font-bold text-red-600"}>delete?</span>
                </span>
                <button
                    onClick={onToggle}
                    className={"text-red-800"}>
                    &times;
                </button>
            </DialogTitle>
            <Description as="div">
                <div className={"px-12 pb-8"}>
                    <p className={"text-lg"}>
                        Are you sure you want to delete this file?
                    </p>
                    <p className={"text-lg text-red-600 text-end"}>
                        *This action is irreversible!
                    </p>
                </div>
                <div className={"flex justify-between px-12 mb-8"}>
                    <button
                        onClick={handleDelete}
                        className={
                            "text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                        }>
                        Confirm delete
                    </button>
                    <button
                        onClick={onToggle}
                        className={
                            "py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100"
                        }>
                        Cancel
                    </button>
                </div>
            </Description>
        </Modal>
    );
}