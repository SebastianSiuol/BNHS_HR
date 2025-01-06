export function getFullName(data) {
    if (data) {
        return `${data.first_name} ${data.last_name}`;
    }

    return "---";
}

export function handleStatus(data) {
    switch (data.toString().toLowerCase()) {
        case "pending":
            return <p className={"text-yellow-600 font-semibold"}>{data}</p>;
        case "approved":
            return <p className={"text-green-700 font-semibold"}>{data}</p>;
        case "rejected":
            return <p className={"text-red-700 font-semibold"}>{data}</p>;
        case "ongoing":
            return <p className={"text-blue-700 font-semibold"}>{data}</p>;
        case "cancelled":
            return <p className={"text-orange-600 font-semibold"}>{data}</p>;
    }
}

export function handleUploadPeriod(data) {
    switch (data.toString().toLowerCase()) {
        case "mid_year":
            return <p>Mid Year</p>;
        case "end_year":
            return <p>End Year</p>;

    }
}