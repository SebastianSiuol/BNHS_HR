import { useState, useEffect} from 'react';
import { Link } from "@inertiajs/react";

// Icons
import { MdOutlineRemoveRedEye } from "react-icons/md";
import { FaTrashAlt } from "react-icons/fa";
import { TiEdit } from "react-icons/ti";

import { FaSearch } from "react-icons/fa";


// Layouts
import { AuthenticatedAdminLayout } from "@/Layouts/AuthenticatedAdminLayout.jsx";
// Components
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";
import { ContentContainer } from "@/Components/ContentContainer.jsx";
import CustomIcon from '@/Components/CustomIcon';
import Pagination from '@/Components/Pagination';

export default function Index({ faculties }) {

    const [ storedFaculties, setStoredFaculties ] = useState([...faculties.data]);

    return (
        <>
            <AuthenticatedAdminLayout>
                    <PageHeaders>Manage Faculties</PageHeaders>
                    <ContentContainer type={"nooutline"}>
                        <SearchHeader />
                        <Table faculties={storedFaculties} />

                        <Pagination data={faculties} />
                    </ContentContainer>
            </AuthenticatedAdminLayout>
        </>
    );
}

function SearchHeader() {
    return (
        <>
            <div className="pb-4 flex items-center justify-between">
                <form className="relative mt-1 grid grid-cols-1 sm:grid-cols-2">
                    <div className="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <FaSearch className="w-4 h-4 text-gray-500 " />
                    </div>
                    <input
                        className="block h-10 sm:w-96 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search for items"
                    />
                    <button
                        type="submit"
                        className="w-32 ml-4 px-4 py-2.5 text-white text-sm text-center font-medium bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300"
                    >
                        Search
                    </button>
                </form>
            </div>
        </>
    );
}

const headers = [
  "Employee ID",
  "Name",
  "Email",
  "Department",
  "Shift",
  "Status",
  "Action",
]

function Table({ faculties }) {


    return (
        <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table className="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead className="text-sm text-white bg-blue-900 text-center">
                    <tr>
                        {headers.map((header, i)=><th className={'px-6 py-3'}>{header}</th> ) }
                    </tr>
                </thead>
                <tbody>
                    {faculties.map((faculty) => {
                        return <TableRow faculty={faculty} key={faculty.id}/>
                    })}
                </tbody>
            </table>
        </div>
    );
}

function TableRow({ faculty }) {

//   console.log(faculty);

  const { faculty_code, email, personal_information, designation, shift } = faculty;
  const { department } = designation;

  const fullName =  `${personal_information.first_name} ${personal_information.last_name}`

    return (
        <tr className={'odd:bg-blue-100 even:bg-white border-b text-center'}>
          <TableItem>{ faculty_code }</TableItem>
          <TableItem>{ fullName }</TableItem>
          <TableItem>{ email }</TableItem>
          <TableItem>{ department.name }</TableItem>
          <TableItem>{ shift.name }</TableItem>
          <TableItem>Active</TableItem>
          <TableItem>
            <div className={'flex items-center justify-end'}>
            <Link><CustomIcon type={'view'}/></Link>
            <Link><CustomIcon type={'edit'}/></Link>
            <Link><CustomIcon type={'delete'}/></Link>
            </div>
          </TableItem>
        </tr>
    );
}

function TableItem({ children }){
  return (<td className={'px-6 py-4 font-medium text-gray-900 whitespace-nowrap'}>
    { children }
  </td>)
}
