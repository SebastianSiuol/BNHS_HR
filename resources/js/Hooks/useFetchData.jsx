import { useEffect, useState } from "react";

export function useFetchData(endpoint) {
    const [data, setData] = useState([]);
    const [error, setError] = useState(null);

    useEffect(() => {
        async function fetchData() {
            try {
                const response = await fetch(endpoint, {
                    method: "GET",
                    headers: { "Content-Type": "application/json" },
                });
                if (response.ok) {
                    const parsedResponse = await response.json();
                    setData(parsedResponse.length > 0 ? parsedResponse : []);
                } else {
                    console.error("Error fetching data:", response.statusText);
                    setError(response.statusText);
                }
            } catch (err) {
                console.error("Error fetching data:", err);
                setError(err.message);
            }
        }

        fetchData();
    }, [endpoint]);

    return { data, setData, error };
}
