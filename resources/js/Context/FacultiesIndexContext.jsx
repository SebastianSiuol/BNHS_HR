import { createContext, useContext, useEffect, useReducer, useState } from "react";
import { router } from "@inertiajs/react";

const FacultiesIndexContext = createContext();

const AUTH_API_KEY = import.meta.env.VITE_AUTH_API_KEY;

const initialState = {
    isLoading: false,
    error: null,
    selectedFacultyDetails: null,
};

function reducer(state, action) {
    switch (action.type) {
        case "FETCH_FACULTY_DETAILS_START":
            return { ...state, isLoading: true, selectedFacultyDetails: null };
        case "FETCH_FACULTY_DETAILS_FINISHED":
            return {
                ...state,
                isLoading: false,
                selectedFacultyDetails: action.payload,
            };
        case "FETCH_FACULTY_DETAILS_ERROR":
            return {
                ...state,
                isLoading: false,
                error: action.payload,
            };
        default:
            throw new Error("Unknown action passed");
    }
}

export function FacultiesIndexProvider({ children }) {
    const [{ selectedFacultyDetails, isLoading, selectedFacultyToDelete }, dispatch] = useReducer(reducer, initialState);

    const [deleteModal, setDeleteModal] = useState(false);
    const [showModal, setShowModal] = useState(false);
    const [ facultyToDelete, setFacultyToDelete ] = useState(null)


    function toggleShowModal(){
        setShowModal((el)=>!el);
    }

    function toggleDeleteModal(data){
        setFacultyToDelete(data);
        setDeleteModal(true)
    }

    function cancelFacultyDelete(){
        setFacultyToDelete(null);
        setDeleteModal(false)
    }

    function confirmFacultyDelete(){
        setDeleteModal(false)
        router.delete(route('admin.faculty.destroy', {faculty: (facultyToDelete.data).toString()}));
    }

    function capitalizeFirstLetter(text) {
        const word = text
            ?.split(" ")
            .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
            .join(" ");

        return word;
    }

    async function fetchFacultyMember(facultyId) {
        try {
            dispatch({ type: "FETCH_FACULTY_DETAILS_START" });
            const response = await fetch(`/api/admin/faculty/show?id=${facultyId}`, {
                method: "GET",
                headers: {
                    "x-auth-api-key": AUTH_API_KEY,
                    "content-type": "application/json",
                },
            });
            const parsedData = await response.json();
            dispatch({
                type: "FETCH_FACULTY_DETAILS_FINISHED",
                payload: parsedData,
            });
        } catch (err) {
            dispatch({
                type: "FETCH_FACULTY_DETAILS_ERROR",
                payload: err.message,
            });
        }
    }

    return (
        <FacultiesIndexContext.Provider
            value={{
                dispatch,
                isLoading,
                selectedFacultyDetails,
                showModal,
                deleteModal,
                capitalizeFirstLetter,
                toggleDeleteModal,
                toggleShowModal,
                fetchFacultyMember,
                cancelFacultyDelete,
                confirmFacultyDelete
            }}
        >
            {children}
        </FacultiesIndexContext.Provider>
    );
}

export function useFacultiesIndex() {
    const context = useContext(FacultiesIndexContext);
    if (context === undefined) throw new Error("Context used outside scope!");
    return context;
}
