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


import { pdfjs, Document, Page } from "react-pdf";
pdfjs.GlobalWorkerOptions.workerSrc = new URL(
    "pdfjs-dist/build/pdf.worker.min.mjs",
    import.meta.url
).toString();

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

    function handleUploadModal() {
        setOpenUploadModal((e) => !e);
    }

    function handleViewDocument(fileId) {
        const fileDownloadUrl = `/faculty/rpms/${fileId}`;
        setCurrentFilePath(fileDownloadUrl);
        setOpenViewFileModal((e) => !e);
    }

    return (
        <>
            <SearchHeaders onUploadModal={handleUploadModal} />
            <RPMSTable data={rpms?.data} onViewFile={handleViewDocument}/>
            <Pagination data={rpms} />
            <UploadModal
                state={openUploadModal}
                onToggle={handleUploadModal}
            />
            <ViewDocumentModal
                state={openViewFileModal}
                onToggle={handleViewDocument}
                filePath={currentFilePath}
            />
        </>
    );
}

function SearchHeaders({ onUploadModal }) {
    const { rpmsConfig } = usePage().props;

    if (!rpmsConfig)
        return (
            <div className="pb-4 sm:flex items-center justify-between">
                Configuration for Uploading is not yet set, please wait for
                admin.
            </div>
        );

    const { mid_year_date: midYearDate, end_year_date: endYearDate } =
        rpmsConfig;

    return (
        <div className="pb-4 sm:flex items-center justify-between dark:bg-gray-900">
            <div className="relative flex mt-1">
                <label htmlFor="table-search">
                    <div className="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <IoSearchSharp
                            className={
                                "w-4 h-4 text-gray-500 dark:text-gray-400"
                            }
                        />
                    </div>
                    <input
                        id="table-search"
                        type="text"
                        placeholder="Search"
                        className="block mr-2 h-10 sm:w-96 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    />
                </label>

            </div>

            <div className="flex border-gray-300 mt-1 px-4 border bg-gray-50 rounded-lg items-center justify-center">
                <div className="mr-4  block items-center justify-center">
                    <h1 className="text-sm">Submission Date:</h1>
                </div>
                <div className="block">
                    <h1 className="text-sm">
                        Mid Year <span className="mr-3"></span> |{" "}
                        <span className="mr-3"></span> Year End
                    </h1>
                    <div className="flex">
                        <p className="text-sm mr-2">{midYearDate}</p>
                        <p className="text-sm">{endYearDate}</p>
                    </div>
                </div>
            </div>

            <div>
                <button
                    type="button"
                    onClick={onUploadModal}
                    className="text-white mt-3 flex items-center justify-between bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    <FaPlus className={"mr-1 w-4 h-4 text-white"} />
                    Upload File
                </button>
            </div>
        </div>
    );
}

function RPMSTable({ data, onViewFile }) {


    const headers = [
        "Date Submitted",
        "File Name",
        "File",
        "Period",
        "Status",
        "Action",
    ];

    const columns = [
        () => "2024-01-01",
        (rpms) => rpms.filename,
        (rpms) => (
            <button onClick={() => onViewFile(rpms.id)}>
                <CustomIcon type="view" />
            </button>
        ),
        (rpms) => handleUploadPeriod(rpms.upload_period),
        (rpms) => handleStatus(capitalizeFirstLetter(rpms?.status)),
        (rpms) => (
            <div className={'flex flex-col'}>
                <button><CustomIcon type="download"/></button>
                <button><CustomIcon type='delete'/></button>
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
    const {
        handleSubmit,
        control,
        reset,
        formState: { errors },
    } = useForm();

    const onSubmit = (data) => {
        console.log("Form Data Submitted: ", data);
        router.post(route("faculty.rpms.store"), data);
    };

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
                        <h1 className="text-lg">{`Upload document for {uploadPeriod}`}</h1>
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

function ViewDocumentModal({ state, onToggle, filePath }) {
    const [numPages, setNumPages] = useState(null);
    const [pageNumber, setPageNumber] = useState(1);

    function onDocumentLoadSuccess({ numPages }) {
        setNumPages(numPages);
    }

    // Reset pageNumber to 1 when filePath changes
    useEffect(() => {
        if (filePath) {
            setPageNumber(1);
        }
    }, [filePath]);

    if (!filePath) {
        return null; // If no file path is provided, don't render the modal
    }

    return (
        <Modal state={state} onToggle={onToggle}>
            <DialogTitle className="flex font-bold text-2xl text-gray-900 justify-between items-center p-4">
                <span>View File</span>
                <button onClick={onToggle} className="text-red-800">
                    &times;
                </button>
            </DialogTitle>
            <Description as="div">
                <hr />
                <div>
                    <Document
                        className="flex"
                        file={filePath} // Use the dynamic file path
                        onLoadSuccess={onDocumentLoadSuccess}
                    >
                        <Page
                            pageNumber={pageNumber}
                            renderTextLayer={false}
                            renderAnnotationLayer={false}
                            customTextRenderer={false}
                        />
                    </Document>
                    <p>
                        Page {pageNumber} of {numPages}
                    </p>
                    <div className="flex gap-4 mt-4">
                        <button
                            disabled={pageNumber <= 1}
                            onClick={() => setPageNumber(pageNumber - 1)}
                            className="px-4 py-2 bg-gray-300 rounded disabled:bg-gray-200"
                        >
                            Previous
                        </button>
                        <button
                            disabled={pageNumber >= numPages}
                            onClick={() => setPageNumber(pageNumber + 1)}
                            className="px-4 py-2 bg-gray-300 rounded disabled:bg-gray-200"
                        >
                            Next
                        </button>
                    </div>
                </div>
            </Description>
        </Modal>
    );
}
