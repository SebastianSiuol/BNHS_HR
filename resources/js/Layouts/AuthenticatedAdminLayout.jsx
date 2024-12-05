import * as DropdownMenu from "@radix-ui/react-dropdown-menu";
import {Link, useForm, usePage} from "@inertiajs/react";
import React, {useState} from 'react';

// Icons
import {IoIosArrowDown, IoIosArrowUp} from "react-icons/io";
import {HiMiniSquares2X2} from "react-icons/hi2";
import {RiTeamFill} from "react-icons/ri";
import { BiCalendar } from "react-icons/bi";
import { LuClipboardList } from "react-icons/lu";



import {SchoolLogo} from "@/Components/SchoolLogo.jsx";
import {SidebarNavLink} from "@/Components/Admin/SidebarNavLink.jsx";
import { AuthSidebarProvider, useAuthSidebar } from "../Context/AuthSidebarContext";



export function AuthenticatedAdminLayout({ children }) {
    const { auth } = usePage().props
    const [headerDropdown, setHeaderDropdown] = useState(false);

    return (
        <>
            <header className={'class="px-3 py-2 lg:px-5 lg:pl-3'}>

                <div className="flex justify-end">
                    <DropdownMenu.Root open={headerDropdown} onOpenChange={()=>{setHeaderDropdown((el)=>!el)}}>
                        <DropdownMenu.Trigger
                            className="bg-gray-200 rounded-lg py-2 px-4 inline-flex items-center space-x-2 hover:bg-gray-300">
                            <div>
                                <p className="font-semibold text-black text-sm">{auth.email}</p>
                                <p className="text-gray-600 text-sm">X Role</p>
                            </div>

                            {headerDropdown
                                ? (<IoIosArrowUp className={'w-8 h-8 text-gray-800 hover:bg-gray-300'} />)
                                : (<IoIosArrowDown className={'w-8 h-8 text-gray-800 hover:bg-gray-300'} />)
                            }

                        </DropdownMenu.Trigger>

                        <DropdownMenu.Content
                            className="z-50 text-base bg-white divide-y divide-gray-100 rounded shadow">

                            <DropdownMenu.Item>
                                <a href="#"
                                   className="block px-4 py-2 text-sm text-gray-700 w-full hover:bg-gray-100">
                                    Switch to Faculty
                                </a>
                            </DropdownMenu.Item>

                            <DropdownMenu.Item>
                                <Link href={route('login.destroy')}
                                      method="post"
                                        className="block px-4 py-2 text-sm text-red-700 w-full text-left hover:bg-gray-100">
                                        Log Out
                                </Link>

                            </DropdownMenu.Item>
                        </DropdownMenu.Content>
                    </DropdownMenu.Root>
                </div>

            </header>

            <AuthSidebarProvider>
                <SideNavbar />
            </AuthSidebarProvider>


            <main className="block p-4 sm:ml-80">
                {children}
            </main>
        </>
    )
}

function SideNavbar() {
    const { openTabs, toggleTab } = useAuthSidebar();

    return (
        <aside
            className={
                "fixed h-screen bg-sidebar text-white top-0 left-0 z-40 w-80 transition-transform -translate-x-full sm:translate-x-0"
            }
        >
            <div className="flex space-x-1 items-center ml-4 mt-11">
                <SchoolLogo type={"sidebar"} />
                <span className="font-bold text-lg hidden md:block text-white">
                    Batasan Hills National High School
                </span>
            </div>

            <div className="pt-5 mb-9">
                <hr className="mx-5" />
            </div>

            <div className="h-full px-3 py-4 overflow-y-auto">
                <ul className="space-y-2 font-medium">
                    <div className="ml-3">
                        <p className="text-sm">Main</p>
                    </div>

                    <li>
                        <SidebarNavLink
                            href={route("admin.dashboard")}
                            active={route().current("admin.dashboard")}
                        >
                            <HiMiniSquares2X2
                                className={
                                    "flex-shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900"
                                }
                            />
                            <span
                                className={
                                    "flex-1 ms-3 text-left whitespace-nowrap group-hover:text-gray-900"
                                }
                            >
                                Dashboard
                            </span>
                        </SidebarNavLink>
                    </li>

                    <div className="ml-3">
                        <p className="text-sm">Management</p>
                    </div>

                    <li>
                        <button
                            onClick={() =>toggleTab('faculty')}
                            className="flex items-center w-full p-2 my-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                        >
                            <RiTeamFill className="ml-5 w-5 h-5 text-white transition duration-75 group-hover:text-gray-900" />

                            <span className="flex-1 ms-3 text-white text-left transition duration-75 whitespace-nowrap group-hover:text-gray-900">
                                Faculties
                            </span>
                            {openTabs.faculty ? (
                                <IoIosArrowUp className="text-white transition duration-75 group-hover:text-gray-900 " />
                            ) : (
                                <IoIosArrowDown className="text-white transition duration-75 group-hover:text-gray-900 " />
                            )}
                        </button>

                        <ul
                            className={`${
                                !openTabs.faculty && "hidden"
                            } ml-8 space-y-2`}
                        >
                            <li>
                                <SidebarNavLink
                                    href={route("faculty.create")}
                                    active={route().current("faculty.create")}
                                    type={"sub"}
                                >
                                    Add Faculties
                                </SidebarNavLink>
                            </li>
                            <li>
                                <SidebarNavLink
                                    href={route("faculty.index")}
                                    active={route().current("faculty.index")}
                                    type={"sub"}
                                >
                                    Manage Faculties
                                </SidebarNavLink>
                            </li>
                        </ul>
                    </li>
                    {/* One Tab */}
                    <li>
                        <button
                            onClick={() =>toggleTab('attendance')}
                            className="flex items-center w-full p-2 my-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                        >
                            <BiCalendar className="ml-5 w-5 h-5 text-white transition duration-75 group-hover:text-gray-900" />

                            <span className="flex-1 ms-3 text-white text-left transition duration-75 whitespace-nowrap group-hover:text-gray-900">
                                Attendance
                            </span>
                            {openTabs.attendance ? (
                                <IoIosArrowUp className="text-white transition duration-75 group-hover:text-gray-900 " />
                            ) : (
                                <IoIosArrowDown className="text-white transition duration-75 group-hover:text-gray-900 " />
                            )}
                        </button>

                        <ul
                            className={`${
                                !openTabs.attendance && "hidden"
                            } ml-8 space-y-2`}
                        >
                            <li>
                                <SidebarNavLink
                                    href={route("faculty.create")}
                                    active={route().current("faculty.create")}
                                    type={"sub"}
                                >
                                    Daily Attendance
                                </SidebarNavLink>
                            </li>
                            <li>
                                <SidebarNavLink
                                    href={route("faculty.index")}
                                    active={route().current("faculty.index")}
                                    type={"sub"}
                                >
                                    Attendance Report
                                </SidebarNavLink>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <button
                            onClick={() =>toggleTab('leave')}
                            className="flex items-center w-full p-2 my-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                        >
                            <LuClipboardList className="ml-5 w-5 h-5 text-white transition duration-75 group-hover:text-gray-900" />

                            <span className="flex-1 ms-3 text-white text-left transition duration-75 whitespace-nowrap group-hover:text-gray-900">
                                Leave
                            </span>
                            {openTabs.leave ? (
                                <IoIosArrowUp className="text-white transition duration-75 group-hover:text-gray-900 " />
                            ) : (
                                <IoIosArrowDown className="text-white transition duration-75 group-hover:text-gray-900 " />
                            )}
                        </button>

                        <ul
                            className={`${
                                !openTabs.leave && "hidden"
                            } ml-8 space-y-2`}
                        >
                            <li>
                                <SidebarNavLink
                                    href={route("faculty.create")}
                                    active={route().current("faculty.create")}
                                    type={"sub"}
                                >
                                    Request Leave
                                </SidebarNavLink>
                            </li>
                            <li>
                                <SidebarNavLink
                                    href={route("faculty.index")}
                                    active={route().current("faculty.index")}
                                    type={"sub"}
                                >
                                    Manage Leave
                                </SidebarNavLink>
                            </li>
                            <li>
                                <SidebarNavLink
                                    href={route("faculty.index")}
                                    active={route().current("faculty.index")}
                                    type={"sub"}
                                >
                                    Service Credit Records
                                </SidebarNavLink>
                            </li>
                            <li>
                                <SidebarNavLink
                                    href={route("faculty.index")}
                                    active={route().current("faculty.index")}
                                    type={"sub"}
                                >
                                    Manage Service Credits
                                </SidebarNavLink>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
    );
}

// className={`${route().current('admin.faculty') ? '' : 'hidden'} ml-10 py-2 space-y-2`}>
