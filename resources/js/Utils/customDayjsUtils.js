import dayjs from "dayjs";
import utc from "dayjs/plugin/utc";
import timezone from "dayjs/plugin/timezone";

dayjs.extend(utc);
dayjs.extend(timezone);

export function getDateToday() {
    return dayjs().format("YYYY-MM-DD");
}


export function formatDate(
    date,
    format = "YYYY-MM-DD",
    tz = "Asia/Manila"
) {
    return dayjs(date).tz(tz).format(format);
}
