import React from 'react';

export function InputLabel({labelFor, children}) {
    return <label htmlFor={labelFor} className={'mb-2 text-white text-sm font-bold'}>{children}</label>;
}
