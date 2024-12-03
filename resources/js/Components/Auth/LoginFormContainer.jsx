import React from 'react';

// Import
import styles from './LoginFormContainer.module.css';

export function LoginFormContainer({ children }) {
    return (
        <div className={`${styles.div} fixed right-0 flex flex-col h-full p-8 items-center max-w-[100%]`}>
            {children}
        </div>
    );
}
