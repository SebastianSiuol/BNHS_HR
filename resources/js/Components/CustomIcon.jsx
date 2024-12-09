import { FaReact } from "react-icons/fa";
import { FaEye } from "react-icons/fa";
import { FaTrashAlt } from "react-icons/fa";
import { RiEdit2Fill } from "react-icons/ri";

export default function CustomIcon({ type='default' }){

const iconType={

  'default': <FaReact className={'w-[27px] h-[27px] text-blue-800'} />,
  'view': <FaEye className={'w-[27px] h-[27px] text-green-600'}/>,
  'edit': <RiEdit2Fill className={'w-[27px] h-[27px] text-blue-800'}/>,
  'delete': <FaTrashAlt className={'w-[27px] h-[27px] text-red-800'}/>
}
  return <>
    {iconType[type]}
  </>
}