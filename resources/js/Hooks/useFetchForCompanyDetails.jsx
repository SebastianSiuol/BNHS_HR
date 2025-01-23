import { useState, useEffect } from "react";

export function useFetchforCompanyDetails({setState, setLoading, setError, link, dependency = undefined}) {
    useEffect(() => {
        if (link) {
            async function fetchDataForCompanyDetails() {
                setLoading(true);
                setError(null);

                try {
                    const fetchResponse = await fetch(link, {
                        method: "GET",
                        headers: {
                            "content-type": "application/json",
                        },
                    });

                    if (!fetchResponse.ok) {
                        throw new Error(
                            `HTTP error! status: ${fetchResponse.status}`
                        );
                    }

                    const parsedData = await fetchResponse.json();
                    setState(parsedData);
                } catch (error) {
                    setError(error.message || "An error occurred.");
                } finally {
                    setLoading(false);
                }
            }
            fetchDataForCompanyDetails();
        }
    }, [dependency]);
}
