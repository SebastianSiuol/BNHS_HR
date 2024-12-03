import React from 'react';
import {IoIosArrowForward} from "react-icons/io";


export function PageHeaders({children}) {
    return (
        <div className="flex items-center pb-8">
            <IoIosArrowForward className="w-9 h-9 text-blue-900"/>
            <h1 className="text-3xl text-blue-900 font-bold ml-2">{children}</h1>
        </div>
    );
}
