import * as DropdownMenu from "@radix-ui/react-dropdown-menu";
import {Link, usePage, router} from "@inertiajs/react";
import React, {useState, useEffect} from 'react';

// Icons
import {IoIosArrowDown, IoIosArrowUp} from "react-icons/io";
import {HiMiniSquares2X2} from "react-icons/hi2";
import {RiTeamFill} from "react-icons/ri";
import { BiCalendar } from "react-icons/bi";
import { LuClipboardList } from "react-icons/lu";
import { FaMedal } from "react-icons/fa";
import { MdOutlineAccountBox } from "react-icons/md";
import { MdConveyorBelt } from "react-icons/md";

import {SchoolLogo} from "@/Components/SchoolLogo.jsx";
import { FlashMessage } from "@/Components/FlashMessage";
import { AuthSidebarProvider, useAuthSidebar } from "@/Context/AuthSidebarContext";


function hasRole(userRoles, targetRole) {
    return userRoles.includes(targetRole);
}


const redirectLinks = [
    { role: 'sis_admin', path: route('sis.admin.redirect'), label: 'SIS', icon: <MdOutlineAccountBox className={"ml-5 flex-shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900"} />},
    { role: 'sis_faculty', path: route('sis.admin.redirect'), label: 'SIS', icon: <MdOutlineAccountBox className={"ml-5 flex-shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900"} />},
    { role: 'logi_admin', path: route('logistics.admin.redirect'), label: 'Logistics System', icon: <MdConveyorBelt className={"ml-5 flex-shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900"} />},
];

export function AuthenticatedAdminLayout({ children }) {
    const { auth, flash, role : userRoles } = usePage().props
    const [ headerDropdown, setHeaderDropdown ] = useState(false);
    const [ flashMessage, setFlashMessage] = useState(flash)

    useEffect(() => {
        setFlashMessage(flash);

        let flashTimer = setTimeout(() => {
            setFlashMessage(null);
        }, 5000);

        return () => {
            setFlashMessage(null), clearTimeout(flashTimer);
        };
    }, [flash]);

    return (
        <>
            <header className={'class="px-3 py-2 lg:px-5 lg:pl-3'}>
                <div className="flex justify-end">
                    <DropdownMenu.Root
                        open={headerDropdown}
                        onOpenChange={() => {
                            setHeaderDropdown((el) => !el);
                        }}
                    >
                        <DropdownMenu.Trigger className="bg-gray-200 rounded-lg py-2 px-4 inline-flex items-center space-x-2 hover:bg-gray-300">
                            <div>
                                <p className="font-semibold text-black text-sm">
                                    {auth.email}
                                </p>
                                <p className="text-gray-600 text-sm">Admin{ userRoles.includes('hr_faculty') && (' | Faculty') }</p>
                            </div>

                            {headerDropdown ? (
                                <IoIosArrowUp
                                    className={
                                        "w-8 h-8 text-gray-800 hover:bg-gray-300"
                                    }
                                />
                            ) : (
                                <IoIosArrowDown
                                    className={
                                        "w-8 h-8 text-gray-800 hover:bg-gray-300"
                                    }
                                />
                            )}
                        </DropdownMenu.Trigger>

                        <DropdownMenu.Content className="z-50 text-base bg-white divide-y divide-gray-100 rounded shadow">
                            {userRoles.includes('hr_faculty') && <DropdownMenu.Item>
                                <Link
                                    href={route('faculty.dashboard')}
                                    className="block px-4 py-2 text-sm text-gray-700 w-full hover:bg-gray-100"
                                >
                                    Switch to Faculty
                                </Link>
                            </DropdownMenu.Item>}

                            <DropdownMenu.Item>
                                <button
                                    onClick={()=>{router.post(route('session.destroy'))}}
                                    className="block px-4 py-2 text-sm text-red-700 w-full text-left hover:bg-gray-100"
                                >
                                    Log Out
                                </button>
                            </DropdownMenu.Item>
                        </DropdownMenu.Content>
                    </DropdownMenu.Root>
                </div>
            </header>

            <AuthSidebarProvider>
                <SideNavbar />
            </AuthSidebarProvider>


                <div className="fixed">
                    {flashMessage && <FlashMessage flash={flashMessage} />}
                </div>
            <main className="relative p-4 sm:ml-80">{children}</main>
        </>
    );
}

function SideNavbar() {
    const { role : userRoles } = usePage().props
    const [ roles, setRoles ] = useState(userRoles);
    const { openTabs, toggleTab } = useAuthSidebar();

    console.log(roles.includes('sis_admin'))

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
                            type={"top"}
                        >
                            <HiMiniSquares2X2
                                className={
                                    "ml-5 flex-shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900"
                                }
                            />
                            <span
                                className={
                                    "flex-1 ms-3 text-left rtl:text-right whitespace-nowrap group-hover:text-gray-900"
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
                        <DropdownButton
                            icon={RiTeamFill}
                            label={"Faculties"}
                            state={"faculty"}
                        />

                        <ul
                            className={`${
                                !openTabs.faculty && "hidden"
                            } ml-8 space-y-2`}
                        >
                            <li>
                                <SidebarNavLink
                                    href={route("admin.faculty.create")}
                                    active={route().current(
                                        "admin.faculty.create"
                                    )}
                                    type={"sub"}
                                >
                                    Add Faculties
                                </SidebarNavLink>
                            </li>
                            <li>
                                <SidebarNavLink
                                    href={route("admin.faculty.index")}
                                    active={route().current(
                                        "admin.faculty.index"
                                    )}
                                    type={"sub"}
                                >
                                    Manage Faculties
                                </SidebarNavLink>
                            </li>
                        </ul>
                    </li>
                    {/* One Tab */}
                    <li>
                        <DropdownButton
                            icon={BiCalendar}
                            label={"Attendance"}
                            state={"attendance"}
                        />

                        <ul
                            className={`${
                                !openTabs.attendance && "hidden"
                            } ml-8 space-y-2`}
                        >
                            <li>
                                <SidebarNavLink
                                    href={route("admin.attendances.create")}
                                    active={route().current(
                                        "admin.attendances.create"
                                    )}
                                    type={"sub"}
                                >
                                    Attendance
                                </SidebarNavLink>
                            </li>
                            <li>
                                <SidebarNavLink
                                    href={route("admin.attendances.index")}
                                    active={route().current(
                                        "admin.attendances.index"
                                    )}
                                    type={"sub"}
                                >
                                    Daily Attendance
                                </SidebarNavLink>
                            </li>
                            <li>
                                <SidebarNavLink
                                    href={route("admin.attendances.report")}
                                    active={route().current(
                                        "admin.attendances.report"
                                    )}
                                    type={"sub"}
                                >
                                    Attendance Report
                                </SidebarNavLink>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <DropdownButton
                            icon={LuClipboardList}
                            label={"Leave"}
                            state={"leave"}
                        />

                        <ul
                            className={`${
                                !openTabs.leave && "hidden"
                            } ml-8 space-y-2`}
                        >
                            <li>
                                <SidebarNavLink
                                    href={route("admin.leaves.index")}
                                    active={
                                        route().current(
                                            "admin.leaves.create"
                                        ) ||
                                        route().current("admin.leaves.index")
                                    }
                                    type={"sub"}
                                >
                                    Request Leave
                                </SidebarNavLink>
                            </li>
                            <li>
                                <SidebarNavLink
                                    // href={route("admin.leaves.index")}
                                    // active={route().current("admin.leaves.index")}
                                    type={"sub"}
                                >
                                    Manage Leave
                                </SidebarNavLink>
                            </li>
                            <li>
                                <SidebarNavLink
                                    href={route("admin.service-credits.index")}
                                    active={route().current(
                                        "admin.service-credits.index"
                                    )}
                                    type={"sub"}
                                >
                                    Manage Service Credits
                                </SidebarNavLink>
                            </li>
                            <li>
                                <SidebarNavLink
                                    href={route("admin.service-credits.report")}
                                    active={route().current(
                                        "admin.service-credits.report"
                                    )}
                                    type={"sub"}
                                >
                                    Service Credit Records
                                </SidebarNavLink>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <SidebarNavLink
                            href={route("admin.rpms.index")}
                            active={route().current("admin.rpms.index")}
                            type={"top"}
                        >
                            <FaMedal
                                className={
                                    "ml-5 flex-shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900"
                                }
                            />
                            <span
                                className={
                                    "flex-1 ms-3 text-left rtl:text-right whitespace-nowrap group-hover:text-gray-900"
                                }
                            >
                                RPMS
                            </span>
                        </SidebarNavLink>
                    </li>

                    <div className="ml-3">
                        <p className="text-sm">Other Systems</p>
                    </div>

                    {/* {redirectLinks.map(({ role, path, label, icon }) =>
                        hasRole(roles, role) ? (
                            <SidebarNavLink key={role} href={path} type={"top"}>
                                {icon}
                                <span
                                    className={
                                        "flex-1 ms-3 text-left rtl:text-right whitespace-nowrap group-hover:text-gray-900"
                                    }
                                >
                                    {label}
                                </span>
                            </SidebarNavLink>
                        ) : null
                    )} */}

                    {userRoles.includes('sis_admin') &&
                    <SidebarNavLink
                        href={route("sis.admin.redirect")}
                        type={"top"}
                    >
                        <MdOutlineAccountBox
                            className={
                                "ml-5 flex-shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900"
                            }
                        />
                        <span
                            className={
                                "flex-1 ms-3 text-left rtl:text-right whitespace-nowrap group-hover:text-gray-900"
                            }
                        >
                            SIS
                        </span>
                    </SidebarNavLink>
                    }
                    {hasRole(roles, 'logi_admin') && <SidebarNavLink
                        href={route("logistics.admin.redirect")}
                        type={"top"}
                    >
                        <MdConveyorBelt
                            className={
                                "ml-5 flex-shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900"
                            }
                        />
                        <span
                            className={
                                "flex-1 ms-3 text-left rtl:text-right whitespace-nowrap group-hover:text-gray-900"
                            }
                        >
                            Logistics
                        </span>
                    </SidebarNavLink>}
                </ul>
            </div>
        </aside>
    );
}
// { role: 'sis_admin', path: route('sis.admin.redirect'), label: 'SIS', icon: <MdOutlineAccountBox className={"ml-5 flex-shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900"} />},
// { role: 'logi_admin', path: route('logistics.admin.redirect'), label: 'Logistics System', icon: <MdConveyorBelt className={"ml-5 flex-shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900"} />},




// className={`${route().current('admin.faculty') ? '' : 'hidden'} ml-10 py-2 space-y-2`}>
function DropdownButton({ icon: Icon, label, state }) {
    const { openTabs, toggleTab } = useAuthSidebar();


    const iconClass = 'ml-5 w-5 h-5 text-white transition duration-75 group-hover:text-gray-900';


    return (
        <button
            onClick={() => toggleTab(`${state}`)}
            className="flex items-center w-full p-2 my-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
        >
            {/* Icon How? */}
            <Icon className={iconClass} />

            <span className="flex-1 ms-3 text-white text-left transition duration-75 whitespace-nowrap group-hover:text-gray-900">
                { label }
            </span>
            {openTabs[state] ? (
                <IoIosArrowUp className="text-white transition duration-75 group-hover:text-gray-900 " />
            ) : (
                <IoIosArrowDown className="text-white transition duration-75 group-hover:text-gray-900 " />
            )}
        </button>
    );
}


export function SidebarNavLink({active = false, type = 'sub', className = '', children, ...props}) {

    return (
        <Link
            {...props}
            className={'flex items-center rounded-lg ' +
                (type === 'top'
                    ? ' mb-1 p-2 '
                    : 'w-full p-2 pl-11 transition duration-75 '
                ) +
                (active
                    ? 'text-gray-900 bg-gray-100 '
                    : 'transition-all duration-300 hover:bg-gray-100 hover:text-black ')
            }
        >
            {children}
        </Link>
    );
}
