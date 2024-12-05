import React from 'react';

export function ContentContainer({ type = 'default' ,children}) {

    const cardClass = {
        default: "bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6",
        nooutline: "ml-2 bg-white border w-full border-gray-200 rounded-md shadow p-4"
    }

    return (<div className={cardClass[type]}>
        {children}
    </div>);
}
