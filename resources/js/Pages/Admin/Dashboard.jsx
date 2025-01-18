import React from 'react';
import { usePage } from '@inertiajs/react';
import {RiTeamFill} from "react-icons/ri";
import {HiOutlineClipboardDocumentCheck} from "react-icons/hi2";
import {FaCircleXmark} from "react-icons/fa6";
import {GrLogout} from "react-icons/gr";

// Components
import {PageHeaders} from "@/Components/Admin/PageHeaders.jsx";


export default function Dashboard() {
    const {totalEmployees, totalPresentToday} = usePage().props


    return (
        <>
            <PageHeaders> Dashboard </PageHeaders>

            <section className="text-gray-700 body-font mb-5">
                <div className="container px-5 mx-auto">
                    <div className="flex flex-wrap -m-4">
                        <div className="p-4 md:w-1/4 sm:w-1/2 w-full">
                            <div className="border-4 border-blue-800 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                <div className="flex items-center justify-start rtl:justify-end px-4 mb-[22px]">
                                    <h2 className="title-font font-semibold text-5xl text-gray-900">{totalEmployees}</h2>
                                    <RiTeamFill className="size-20 ml-auto text-indigo-500" />
                                </div>
                                <div className="pl-4 pr-0">
                                    <p className="leading-relaxed text-xl">Total Employees</p>
                                </div>
                            </div>
                        </div>
                        <div className="p-4 md:w-1/4 sm:w-1/2 w-full">
                            <div className="border-4 border-blue-800 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                <div className="flex items-center justify-start rtl:justify-end mb-4">
                                    <h2 className="title-font font-semibold text-5xl text-gray-900">{totalPresentToday}</h2>

                                    <HiOutlineClipboardDocumentCheck className="size-20 ml-auto text-green-500" />
                                </div>
                                <p className="leading-relaxed text-2xl">Present Today</p>
                            </div>
                        </div>
                        <div className="p-4 md:w-1/4 sm:w-1/2 w-full">
                            <div className="border-4 border-blue-800 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                <div className="flex items-center justify-start rtl:justify-end mb-4">
                                    <h2 className="title-font font-semibold text-5xl text-gray-900">0</h2>

                                    <FaCircleXmark className="size-20 ml-auto text-red-700" />
                                </div>
                                <p className="leading-relaxed text-2xl">Total Absent</p>
                            </div>
                        </div>
                        <div className="p-4 md:w-1/4 sm:w-1/2 w-full">
                            <div className="border-4 border-blue-800 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                <div className="flex items-center justify-start rtl:justify-end px-4 mb-[22px]">
                                    <h2 className="title-font font-semibold text-5xl text-gray-900">1</h2>

                                    <GrLogout className="size-20 ml-auto text-indigo-500" />
                                </div>
                                <p className="leading-relaxed text-xl pl-4 mt-5">On Leave Today</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div className="mx-5 bg-white border border-gray-200 rounded-lg shadow p-4">
                    <div className="flex items-center mb-5 pl-5 pt-5 gap-4">
                        <h1 className="text-xl font-medium leading-tight tracking-tight text-gray-900 md:text-2xl">Announcements</h1>
                    </div>

                    <div className="p-5 bg-gray-200 border-t-2 border-t-gray-300">
                        <div className="flex items-center justify-end">
                            <button
                                data-modal-target="crud-modal"
                                data-modal-toggle="crud-modal"
                                className="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button"
                            >
                                Add New Announcement
                            </button>
                        </div>

                        {/* <div id="crud-modal" tabIndex="-1" aria-hidden="true" className="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div className="relative p-4 w-full max-w-md max-h-full">
                                <div className="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div className="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 className="text-lg font-semibold text-gray-900 dark:text-white">Create New Announcement</h3>
                                        <button type="button" className="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                            <svg className="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span className="sr-only">Close modal</span>
                                        </button>
                                    </div>

                                    <form className="p-4 md:p-5">
                                        <div className="grid gap-4 mb-4 grid-cols-2">
                                            <div className="col-span-2">
                                                <label htmlFor="name" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Announcement Title
                                                </label>
                                                <input
                                                    type="text"
                                                    name="name"
                                                    id="name"
                                                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Announcement title"
                                                    required=""
                                                />
                                            </div>
                                            <div className="col-span-2">
                                                <label htmlFor="description" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Description
                                                </label>
                                                <textarea
                                                    id="description"
                                                    rows="4"
                                                    className="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Description..."
                                                ></textarea>
                                            </div>

                                            <div className="col-span-2">
                                                <label htmlFor="joining-letter" className="block mr-8 mb-2 text-sm font-medium text-gray-900 ">
                                                    Attach File
                                                </label>
                                                <input className="block w-full mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   " id="file_1" type="file" />
                                                <input className="hidden w-full mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   " id="file_2" type="file" />
                                                <input className="hidden w-full mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   " id="file_3" type="file" />
                                                <input className="hidden w-full mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   " id="file_4" type="file" />
                                                <input className="hidden w-full mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   " id="file_5" type="file" />
                                            </div>
                                            <div className="flex items-center justify-center col-span-2">
                                                <button id="add-file" type="button">
                                                    <svg className="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div className="flex items-center justify-end">
                                            <button
                                                type="submit"
                                                className="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                            >
                                                Publish
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> */}

                        <ul className="mt-4 space-y-2">
                            <li>
                                <button className="block text-left w-full h-full bg-white border border-gray-200 rounded-lg shadow p-4 transform transition duration-500 hover:scale-105">
                                    <strong className="font-semibold text-gray-900">Announcement A</strong>

                                    <p className="mt-1 text-xs font-medium text-gray-800">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime consequuntur deleniti, unde ab ut in!</p>
                                </button>
                            </li>
                            <li>
                                <button className="block text-left w-full h-full bg-white border border-gray-200 rounded-lg shadow p-4 transform transition duration-500 hover:scale-105">
                                    <strong className="font-semibold text-gray-900">Announcement B</strong>

                                    <p className="mt-1 text-xs font-medium text-gray-800">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime consequuntur deleniti, unde ab ut in!</p>
                                </button>
                            </li>
                            <li>
                                <button className="block text-left w-full h-full bg-white border border-gray-200 rounded-lg shadow p-4 transform transition duration-500 hover:scale-105">
                                    <strong className="font-semibold text-gray-900">Announcement C</strong>

                                    <p className="mt-1 text-xs font-medium text-gray-800">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime consequuntur deleniti, unde ab ut in!</p>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </>
    );
}
