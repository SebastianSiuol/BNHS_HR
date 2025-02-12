import { useEffect } from "react";

export function useFetchCompanyDetails({setState, setLoading, setError, link, dependency=null}) {
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
                    setState(parsedData);L
                } catch (error) {
                    setError(error.message || "An error occurred.");
                } finally {
                    setLoading(false);
                }
            }
            fetchDataForCompanyDetails();
        }
    }, [dependency]);
    // Renamed
}
