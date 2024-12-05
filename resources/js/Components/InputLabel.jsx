import React from 'react';

export function InputLabel({labelFor, color = 'white', width = 'bold', children}) {

    const fontColor = {
        'white': 'text-white ',
        'black':'text-black '
    }

    const fontWidth = {
        'normal' : 'font-normal ',
        'bold' : 'font-bold '
    }

    return <>
        <label
            htmlFor={labelFor}
            className={'mb-2 text-sm font-bold font ' +
                (fontColor[color]) + (fontWidth[width])
        }>
            {children}
        </label></>;
}
