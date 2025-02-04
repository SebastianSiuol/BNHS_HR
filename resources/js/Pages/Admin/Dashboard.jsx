import { useState } from "react";
import { usePage, router } from "@inertiajs/react";
import { useForm, Controller } from "react-hook-form";
import { Description, DialogTitle } from "@headlessui/react";
import ReactApexCharts from 'react-apexcharts'
import { formatDate } from "@/Utils/customDayjsUtils";

// Icons
import { RiTeamFill } from "react-icons/ri";
import { HiOutlineClipboardDocumentCheck } from "react-icons/hi2";
import { FaCircleXmark } from "react-icons/fa6";
import { GrLogout } from "react-icons/gr";

// Components
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";
import { LabelInput } from "@/Components/LabelInput";
import { LabelTextbox } from "@/Components/LabelTextbox";
import { FileInput } from "@/Components/FileInput";
import Modal from "@/Components/Modal.jsx";
import FileUploadProgressModal from "@/Components/FileUploadProgressModal";


export default function Dashboard() {
    const { totalEmployees, totalPresentToday, announcements } =
        usePage().props;

    const [isAnnouncementModalOpen, setIsAnnouncementModalOpen] =
        useState(false);

    const [isAnnouncementView, setIsAnnouncementView] =
    useState(false);

    const [selectedAnnouncement, setSelectedAnnouncement] = useState(null);

    const [uploadProgress, setUploadProgress] = useState(0);
    const [isUploadProgressModal, setIsUploadProgressModal] = useState(false);

    function handleAnnouncementModal() {
        setIsAnnouncementModalOpen((e) => !e);
    }

    function handleAnnouncementView(id){
        const selectAnnc = announcements.find((ann)=>ann.id === id);
        setSelectedAnnouncement(selectAnnc);
        setIsAnnouncementView((e)=>!e);
    }

    return (
        <>
            <PageHeaders> Dashboard </PageHeaders>
            <AnnouncementModal
                modal={isAnnouncementModalOpen}
                toggleModal={handleAnnouncementModal}
                setUploadProgress={setUploadProgress}
                setUploadProgressModal={setIsUploadProgressModal}
            />
            <ViewAnnouncement
                modal={isAnnouncementView}
                toggleModal={() => setIsAnnouncementView((e) => !e)}
                data={selectedAnnouncement}
            />
            <FileUploadProgressModal
                isOpen={isUploadProgressModal}
                progress={uploadProgress}
            />

            <section className="text-gray-700 body-font mb-5">
                <div className="container px-5 mx-auto">
                    <div className="flex flex-wrap -m-4">
                        <div className="p-4 md:w-1/4 sm:w-1/2 w-full">
                            <div className="border-4 border-blue-800 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                <div className="flex items-center justify-start rtl:justify-end px-4 mb-[22px]">
                                    <h2 className="title-font font-semibold text-5xl text-gray-900">
                                        {totalEmployees}
                                    </h2>
                                    <RiTeamFill className="size-20 ml-auto text-indigo-500" />
                                </div>
                                <div className="pl-4 pr-0">
                                    <p className="leading-relaxed text-xl">
                                        Total Employees
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div className="p-4 md:w-1/4 sm:w-1/2 w-full">
                            <div className="border-4 border-blue-800 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                <div className="flex items-center justify-start rtl:justify-end mb-4">
                                    <h2 className="title-font font-semibold text-5xl text-gray-900">
                                        {totalPresentToday}
                                    </h2>

                                    <HiOutlineClipboardDocumentCheck className="size-20 ml-auto text-green-500" />
                                </div>
                                <p className="leading-relaxed text-2xl">
                                    Present Today
                                </p>
                            </div>
                        </div>
                        <div className="p-4 md:w-1/4 sm:w-1/2 w-full">
                            <div className="border-4 border-blue-800 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                <div className="flex items-center justify-start rtl:justify-end mb-4">
                                    <h2 className="title-font font-semibold text-5xl text-gray-900">
                                        0
                                    </h2>

                                    <FaCircleXmark className="size-20 ml-auto text-red-700" />
                                </div>
                                <p className="leading-relaxed text-2xl">
                                    Total Absent
                                </p>
                            </div>
                        </div>
                        <div className="p-4 md:w-1/4 sm:w-1/2 w-full">
                            <div className="border-4 border-blue-800 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                <div className="flex items-center justify-start rtl:justify-end px-4 mb-[22px]">
                                    <h2 className="title-font font-semibold text-5xl text-gray-900">
                                        1
                                    </h2>

                                    <GrLogout className="size-20 ml-auto text-indigo-500" />
                                </div>
                                <p className="leading-relaxed text-xl pl-4 mt-5">
                                    On Leave Today
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div className={'w-[36vw] p-4 m-5 bg-white border border-gray-200 rounded-lg shadow'}>

                    <ReactApexChart />
                    <div className={'text-center'}>
                        <h2>Faculty Count per Department</h2>
                    </div>
                </div>

            </section>

            <section>
                <div className="mx-5 bg-white border border-gray-200 rounded-lg shadow p-4">
                    <div className="flex items-center mb-5 pl-5 pt-5 gap-4">
                        <h1 className="text-xl font-medium leading-tight tracking-tight text-gray-900 md:text-2xl">
                            Announcements
                        </h1>
                    </div>

                    <div className="p-5 bg-gray-200 border-t-2 border-t-gray-300">
                        <div className="flex items-center justify-end">
                            <button
                                onClick={handleAnnouncementModal}
                                className="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                Add New Announcement
                            </button>
                        </div>

                        <ul className="mt-4 space-y-2">
                            {announcements.length > 0 ? (
                                announcements.map((announcement) => (
                                    <li key={announcement.id}>
                                        <button
                                            onClick={() => {
                                                handleAnnouncementView(
                                                    announcement.id
                                                );
                                            }}
                                            className="block text-left w-full h-full bg-white border border-gray-200 rounded-lg shadow p-4 transform transition duration-500 hover:scale-105"
                                        >
                                            <strong className="font-semibold text-gray-900">
                                                {announcement.title}
                                            </strong>

                                            <p className="mt-1 text-xs font-medium text-gray-800">
                                                {announcement.description}
                                            </p>

                                            <p className="mt-1 text-xs font-medium text-gray-800">
                                                {formatDate(announcement.createdAt, 'MM-DD-YYYY hh:mm A')}
                                            </p>
                                        </button>
                                    </li>
                                ))
                            ) : (
                                <div className="block text-center w-full h-full bg-white border border-gray-200 rounded-lg shadow p-4 transform transition duration-500 hover:scale-105">
                                    <strong className="font-semibold text-gray-900">
                                        No Announcements
                                    </strong>
                                </div>
                            )}
                        </ul>
                    </div>
                </div>
            </section>
        </>
    );
}

function AnnouncementModal({ modal, toggleModal, setUploadProgress, setUploadProgressModal }) {

    const {
        register,
        handleSubmit,
        control,
        formState: { errors },
    } = useForm();

    function publishAnnouncement(data ,e){
        e.preventDefault();
        setUploadProgressModal(true);
        router.post(route("announcement.store"), data, {
            onProgress: (progress) => {
                const percentage = Math.round((progress.loaded / progress.total) * 100);
                setUploadProgress(percentage);
            },
            onSuccess: () => {
                setUploadProgressModal(false);
                toggleModal();
            },
            onError: () => {
                setUploadProgressModal(false);
                toggleModal();
            },
        });

    }

    return (
        <>
            <Modal state={modal} onToggle={toggleModal}>
                <DialogTitle
                    as={"div"}
                    className="flex p-6 font-bold text-xl justify-between items-center"
                >
                    <h3>Add new announcement</h3>
                    <button onClick={toggleModal} className={"text-red-500"}>
                        &times;
                    </button>
                </DialogTitle>
                <Description as={"div"} className="p-6 space-y-2">
                    <div className={"flex-col p-1 justify-end items-center"}>
                        <LabelInput
                            id={"title"}
                            register={register}
                            label={"Announcement Title"}
                            error={errors}
                        />
                        <LabelTextbox
                            id={"description"}
                            register={register}
                            label={"Announcement Description"}
                            error={errors}
                        />
                        <label className="my-2 text-sm space-y-2 text-black">
                            <span>Optional Documents</span>
                            <Controller
                                name="announcement_document"
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
                                    />
                                )}
                            />
                        </label>
                    </div>
                    <div className={"flex p-2 justify-end items-center"}>
                        <button
                            type="button"
                            onClick={handleSubmit(publishAnnouncement)}
                            className={
                                "text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                            }
                        >
                            Publish
                        </button>
                    </div>
                </Description>
            </Modal>
        </>
    );
}

function ViewAnnouncement({ modal, toggleModal, data }) {

    function handleDeleteAnnouncement(id){
        router.delete(route('announcement.destroy', id), {
            onSuccess: ()=>{
                toggleModal();
            },
            onError: ()=>{
                toggleModal();
            }
        })
    }
    return (
        <Modal state={modal} onToggle={toggleModal}>
            <DialogTitle
                as={"div"}
                className="flex p-6 font-bold text-xl justify-between items-center w-[40vw]"
            >
                <div>

                <h3>Announcement</h3>
                <div className={'text-sm font-normal'}>{formatDate(data?.createdAt, 'MM-DD-YYYY hh:mm A')}</div>
                </div>
                <button onClick={toggleModal} className={"text-red-500"}>
                    &times;
                </button>
            </DialogTitle>
            <Description as={"div"} className="p-6 space-y-5 w-[40vw]">
                <div>
                    <h3 className={"font-bold text-lg"}>Title:</h3>
                    <p>{data?.title}</p>
                </div>

                <div>
                    <h3 className={"font-bold text-lg"}>Description:</h3>
                    <p>{data?.description}</p>
                </div>

                <div>
                    <h3 className={"font-bold text-lg"}>File:</h3>

                    {data?.fileUrl ? (
                        <iframe
                            src={data?.fileUrl}
                            width={"100%"}
                            height={"600px"}
                        />
                    ) : (
                        <div> No File Attached</div>
                    )}
                </div>
                <div className={"flex p-2 justify-end items-center"}>
                        <button
                            type="button"
                            onClick={()=>{handleDeleteAnnouncement(data?.id)}}
                            className={
                                "text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                            }
                        >
                            Delete
                        </button>
                    </div>
            </Description>
        </Modal>
    );
}

function ReactApexChart() {
    const {departmentCount} = usePage().props;

    console.log(departmentCount);

    const departments = Object.keys(departmentCount);
    const facultyCount = Object.values(departmentCount);

    const [state, setState] = useState({
        series: facultyCount,
        options: {
            chart: {
                type: "pie",
            },
            labels: departments,
            dataLabels: {
                formatter: function (val, opts) {
                    return opts.w.config.series[opts.seriesIndex]
                },
            },
            legends: {
                showForZeroSeries: true,
                showForNullSeries: true,
            }
        },

    });

    return (
              <ReactApexCharts options={state.options} series={state.series} type="pie" />
      );
    }