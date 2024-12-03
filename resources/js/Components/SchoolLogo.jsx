import React from 'react';

export function SchoolLogo({type}) {

    const divClass = {
        'welcome': 'h-[40%] w-[60%]',
        'sidebar': 'rounded-full w-20 h-15 flex items-center justify-center'
    }

    return <>
        <div className={type === "welcome" ? divClass.welcome : divClass.sidebar}>


            <img src={'/imgs/bhnhs_logo.png'} alt="BHNHS-Logo"
                 className={'h-full w-full object-contain'}/>
        </div>
    </>
}
