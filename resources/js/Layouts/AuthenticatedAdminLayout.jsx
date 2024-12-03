import {Link, useForm, usePage} from "@inertiajs/react";

import React, {useState} from 'react';
import {IoIosArrowDown, IoIosArrowUp} from "react-icons/io";
import {HiMiniSquares2X2} from "react-icons/hi2";
import {RiTeamFill} from "react-icons/ri";
import * as DropdownMenu from "@radix-ui/react-dropdown-menu";

import {SchoolLogo} from "@/Components/SchoolLogo.jsx";
import {SidebarNavLink} from "@/Components/Admin/SidebarNavLink.jsx";



export function AuthenticatedAdminLayout({ children }) {
    const { auth } = usePage().props

    const [isOpen, setIsOpen] = useState(false);
    const [headerDropdown, setHeaderDropdown] = useState(false);

    const { post } = useForm();


    function handleSidebarDropdown() {
        setIsOpen((el) => !el);
    }

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


            <aside
                className={"fixed h-screen bg-sidebar text-white top-0 left-0 z-40 w-80 transition-transform -translate-x-full sm:translate-x-0"}>
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
                            <button onClick={handleSidebarDropdown}
                                    className="flex items-center w-full p-2 my-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100">

                                <RiTeamFill
                                    className="ml-5 w-5 h-5 text-white transition duration-75 group-hover:text-gray-900"/>

                                <span
                                    className="flex-1 ms-3 text-white text-left transition duration-75 whitespace-nowrap group-hover:text-gray-900">
                                    Employees
                                </span>
                                {isOpen
                                    ? (<IoIosArrowUp
                                        className="text-white transition duration-75 group-hover:text-gray-900 "/>)
                                    : (<IoIosArrowDown
                                        className="text-white transition duration-75 group-hover:text-gray-900 "/>)

                                }



                            </button>

                            <ul className={`${!isOpen && 'hidden'} ml-8 space-y-2`}>
                                <li>
                                    <SidebarNavLink href={route('faculty.create')}
                                                    active={route().current('faculty.create')} type={"sub"}>
                                        Add Employee
                                    </SidebarNavLink>
                                </li>
                                <li>
                                    <SidebarNavLink href={route('admin.dashboard')}
                                                    active={route().current('admin.dashboard')} type={"sub"}>
                                        Manage Employee
                                    </SidebarNavLink>
                                </li>
                            </ul>

                        </li>


                    </ul>
                </div>
            </aside>


            <main className="block p-4 sm:ml-80">
                {children}
            </main>
        </>
    )
}

// className={`${route().current('admin.faculty') ? '' : 'hidden'} ml-10 py-2 space-y-2`}>
