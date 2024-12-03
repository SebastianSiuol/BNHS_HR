import React from 'react';
import {Link} from '@inertiajs/react';

export function SidebarNavLink({active = false, type = 'sub', className = '', children, ...props}) {
    return (
        <Link
            {...props}
            className={'flex items-center rounded-lg ' +
                (type === 'top'
                    ? 'ml-5 mb-1 p-2 '
                    : 'w-full p-2 pl-11 transition duration-75 '
                ) +
                (active
                    ? 'text-gray-900 bg-gray-100 '
                    : 'transition-all duration-300 hover:bg-gray-100 hover:text-black ')
            }
        >
            {children}
        </Link>
    );
}
