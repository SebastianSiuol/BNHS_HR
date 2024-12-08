import DatePicker from "react-datepicker";
import dayjs from "dayjs";

export default function CustomDatePicker({ value, error, name}) {

  const datePickerClass = "w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-blue-600 focus:border-blue-600"

  function formatToIso(date) {
      return dayjs(date, "MM-DD-YYYY").format("YYYY-MM-DD");
  }

    return (
        <>
            <DatePicker
                selected={value.value}
                onChange={(date) => value.onChange(formatToIso(date))}
                dateFormat={"MM-dd-yyyy"}
                showMonthDropdown
                showYearDropdown
                dropdownMode="select"
                className={datePickerClass + (error[name] ? ' border-red-500 ' : '')}
            />
            {error && (
                <div className="flex justify-end">
                    <p className="text-red-500 text-sm italic">
                        {error[name]?.message}
                    </p>
                </div>
            )}
        </>
    );
}
