import { FaCalendarAlt } from "react-icons/fa";

import DatePicker from "react-datepicker";
import dayjs from "dayjs";

export default function CustomDatePicker({ value, error, name, minimumDate, maximumDate, disabled=false}) {

  const datePickerClass = "w-full p-2.5 text-gray-900 text-sm bg-gray-50 border border-gray-300 rounded-md focus:ring-blue-600 focus:border-blue-600"

  function formatToIso(date) {
    if(date){
        return dayjs(date, "MM-DD-YYYY").format("YYYY-MM-DD");

    }

    return ""
  }

    return (
        <div className={'flex flex-col'}>
            <DatePicker
                selected={value.value}
                onChange={(date) => value.onChange(formatToIso(date))}
                className={datePickerClass + (error[name] ? ' border-red-500 ' : '')}
                dateFormat={"MM-dd-yyyy"}
                showMonthDropdown
                showYearDropdown
                minDate={minimumDate ?? dayjs().toDate()}
                maxDate={maximumDate ?? null}
                dropdownMode="select"
                placeholderText={dayjs().toDate().toLocaleDateString()}
                // Icons
                icon={<FaCalendarAlt />}
                calendarIconClassName={"text-blue-900"}
                showIcon={true}
                disabled={disabled}
            />
            {error && (
                <div className={error ? 'block' : 'hidden'}>
                    <p className="text-red-500 text-sm italic">
                        {error[name]?.message}
                    </p>
                </div>
            )}
        </div>
    );
}
