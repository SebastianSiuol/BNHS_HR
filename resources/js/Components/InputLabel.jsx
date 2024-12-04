import React from 'react';

export function InputLabel({labelFor, color = 'white', thickness = 'bold', children}) {

    const fontColor = {
        'white': 'text-white ',
        'black':'text-black '
    }

    const fontThickness = {
        'normal' : 'font-normal ',
        'bold' : 'font-bold '
    }

    return <>
        <label
            htmlFor={labelFor}
            className={'mb-2 text-sm font-bold font ' +
                (fontColor[color]) + (fontThickness[thickness])
        }>
            {children}
        </label></>;
}
