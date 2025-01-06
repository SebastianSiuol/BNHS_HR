import { FaReact, FaEye, FaTrashAlt} from "react-icons/fa";
import { RiEdit2Fill } from "react-icons/ri";
import { TbCancel } from "react-icons/tb";
import { FiDownload } from "react-icons/fi";


export default function CustomIcon({ type='default', sizes = 'w-[27px] h-[27px]'}){

const iconType={

  'default': <FaReact className={`${sizes} text-blue-800`}/>,
  'view': <FaEye className={`${sizes} text-green-600`}/>,
  'edit': <RiEdit2Fill className={`${sizes} text-blue-800`}/>,
  'delete': <FaTrashAlt className={`${sizes} text-red-800`}/>,
  'cancel': <TbCancel className={`${sizes} text-red-800`}/>,
  'download': <FiDownload className={`${sizes} text-blue-800`}/>
}
  return <>
    {iconType[type]}
  </>
}