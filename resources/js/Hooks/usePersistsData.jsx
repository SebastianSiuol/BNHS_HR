import { useEffect } from "react";

export function usePersistsData({ value, localStorageKey }) {
    useEffect(
        function () {
            localStorage.setItem(localStorageKey, JSON.stringify(value));
        },
        [localStorageKey, value]
    );

}
