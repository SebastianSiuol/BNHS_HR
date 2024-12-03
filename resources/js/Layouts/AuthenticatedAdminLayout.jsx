import {SchoolLogo} from "@/Components/SchoolLogo.jsx";

import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/react'
import {IoIosArrowDown} from "react-icons/io";
import {HiMiniSquares2X2} from "react-icons/hi2";
import {RiTeamFill} from "react-icons/ri";

import {SidebarNavLink} from "@/Components/Admin/SidebarNavLink.jsx";

export function AuthenticatedAdminLayout(props) {
    return (
        <>
            <aside
                className={"fixed h-screen bg-sidebar text-white z-40 w-80 transition-transform -translate-x-full sm:translate-x-0"}>
                <div className="flex space-x-1 items-center ml-4 mt-11">
                    <SchoolLogo type={"sidebar"}/>
                    <span
                        className="font-bold text-lg hidden md:block text-white">Batasan Hills National High School</span>
                </div>

                <div className="pt-5 mb-9">
                    <hr className="mx-5"/>
                </div>

                <div className="h-full px-3 py-4 overflow-y-auto">
                    <ul className="space-y-2 font-medium">

                        <div className="ml-3">
                            <p className="text-sm">Main</p>
                        </div>

                        <li>
                            <SidebarNavLink href={route('admin.dashboard')} active={route().current('admin.dashboard')}>
                                <HiMiniSquares2X2
                                    className={"flex-shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900"}/>
                                <span
                                    className={"flex-1 ms-3 text-left whitespace-nowrap group-hover:text-gray-900"}>Dashboard</span>
                            </SidebarNavLink>
                        </li>

                        <div className="ml-3">
                            <p className="text-sm">Management</p>
                        </div>
                        <li>
                            <button
                                className="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                            >
                                <RiTeamFill
                                    className="flex-shrink-0 ml-5 w-5 h-5 text-white transition duration-75 group-hover:text-gray-900"/>
                                <span
                                    className="flex-1 ms-3 text-white text-left rtl:text-right whitespace-nowrap group-hover:text-gray-900">Employees</span>
                                <IoIosArrowDown
                                    className="text-white transition duration-75 group-hover:text-gray-900 "/>
                            </button>

                            <ul className={`ml-8 space-y-2`}>
                                <li>
                                    <SidebarNavLink href={route('admin.faculty')}
                                                    active={route().current('admin.faculty')} type={"sub"}>
                                        Add Employee
                                    </SidebarNavLink>
                                </li>
                                <li>
                                    <SidebarNavLink href={route('admin.faculty')}
                                                    active={route().current('admin.faculty')} type={"sub"}>
                                        Manage Employee
                                    </SidebarNavLink>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </aside>
        </>
    )
}

// className={`${route().current('admin.faculty') ? '' : 'hidden'} ml-10 py-2 space-y-2`}>
