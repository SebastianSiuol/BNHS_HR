import { createContext, useContext, useEffect, useState } from "react";

const AuthSidebarContext = createContext();

export function AuthSidebarProvider({ children }) {
    const SIDEBAR_KEY = 'sidebarState'

    const [openTabs, setOpenTabs] = useState(()=>{
        const savedTabs = sessionStorage.getItem(SIDEBAR_KEY);
        return savedTabs ? JSON.parse(savedTabs) : {};
    })

    useEffect(function(){
        sessionStorage.setItem(SIDEBAR_KEY, JSON.stringify(openTabs))
    },[openTabs])

    function toggleTab(tab){
        setOpenTabs((prev)=>({... prev, [tab]: !prev[tab]}));

    }

    return (
        <AuthSidebarContext.Provider
            value={{ openTabs, toggleTab }}
        >
            {children}
        </AuthSidebarContext.Provider>
    );
}

export function useAuthSidebar() {
    const context = useContext(AuthSidebarContext);
    if (context === undefined) throw new Error("Context used outside scope!");
    return context;
}
