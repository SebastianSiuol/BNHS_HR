import React from 'react';

export function ContentContainer({children}) {
    return (<div className="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
        {children}
    </div>);
}
