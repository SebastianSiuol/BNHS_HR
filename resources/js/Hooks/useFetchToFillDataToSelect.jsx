import { useEffect } from "react";

export function useFetchToFillDataToSelect({ setState, apiKey, link, dependency=null}) {
    useEffect(function () {
        async function getFetch() {
            try {
                const fetchResponse = await fetch(link, {
                    method: "GET",
                    headers: {
                        "x-auth-api-key": apiKey,
                        "content-type": "application/json",
                    },
                });

                const parsedData = await fetchResponse.json();

                if (parsedData) {
                    setState(parsedData);
                }
            } catch (error) {
                console.error(error);
            }
        }
        getFetch();
    }, [dependency]);
}
