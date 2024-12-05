import { FaReact } from "react-icons/fa";
import { MdOutlineRemoveRedEye } from "react-icons/md";
import { FaTrashAlt } from "react-icons/fa";
import { TiEdit } from "react-icons/ti";


export default function CustomIcon({ type='default' }){

const iconType={

  'default': <FaReact className={'w-[27px] h-[27px] text-blue-800'} />,
  'view': <MdOutlineRemoveRedEye className={'w-[27px] h-[27px] text-green-600'}/>,
  'edit': <TiEdit className={'w-[27px] h-[27px] text-blue-800'}/>,
  'delete': <FaTrashAlt className={'w-[27px] h-[27px] text-red-800'}/>
}
  return <>
    {iconType[type]}
  </>
}