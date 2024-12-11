import { AuthenticatedAdminLayout } from "@/Layouts/AuthenticatedAdminLayout.jsx";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";

export default function Index() {
    return (
        <>
            <PageHeaders>Manage Service Credits</PageHeaders>
            <HandlePage />
        </>
    );
}

function HandlePage() {
    return (
        <>
            <div className="sm:flex">
                <div className="relative p-4 w-full max-h-full">
                    <div className="relative bg-white border border-gray-300 rounded-lg shadow ">
                        <div className="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                            <h3 className="text-lg font-semibold text-gray-900 ">
                                Service Credit Calculation
                            </h3>
                        </div>
                        <form className="p-4 md:p-5">
                            <div className="grid gap-4 mb-4">
                                <div id="employeeFields" className="">
                                    <label
                                        for="empID"
                                        className="block mb-2 text-sm font-medium text-gray-900 "
                                    >
                                        Employee Name
                                    </label>

                                    <div
                                        id="field1"
                                        className="flex items-center mb-2"
                                    >
                                        <input
                                            id="emp1"
                                            type="text"
                                            pattern="[A-Za-z\s]+"
                                            name="name"
                                            className="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     "
                                            placeholder="Employee name"
                                            required=""
                                        />
                                    </div>

                                    <div
                                        id="field2"
                                        className="flex items-center hidden mb-2"
                                    >
                                        <input
                                            id="emp2"
                                            type="text"
                                            pattern="[A-Za-z\s]+"
                                            name="name"
                                            className="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     "
                                            placeholder="Employee name"
                                        />
                                        <button
                                            type="button"
                                            className="ml-2"
                                            onclick="removeField(2)"
                                        >
                                            <svg
                                                className="w-6 h-6 text-gray-800 "
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                fill="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm5.757-1a1 1 0 1 0 0 2h8.486a1 1 0 1 0 0-2H7.757Z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </div>

                                    <div
                                        id="field3"
                                        className="flex items-center hidden mb-2"
                                    >
                                        <input
                                            id="emp3"
                                            type="text"
                                            pattern="[A-Za-z\s]+"
                                            name="name"
                                            className="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     "
                                            placeholder="Employee name"
                                        />
                                        <button
                                            type="button"
                                            className="ml-2 "
                                            onclick="removeField(3)"
                                        >
                                            <svg
                                                className="w-6 h-6 text-gray-800 "
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                fill="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm5.757-1a1 1 0 1 0 0 2h8.486a1 1 0 1 0 0-2H7.757Z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </div>

                                    <div
                                        id="field4"
                                        className="flex items-center hidden mb-2"
                                    >
                                        <input
                                            id="emp4"
                                            type="text"
                                            pattern="[A-Za-z\s]+"
                                            name="name"
                                            className="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     "
                                            placeholder="Employee name"
                                        />
                                        <button
                                            type="button"
                                            className="ml-2 text-red-500"
                                            onclick="removeField(4)"
                                        >
                                            <svg
                                                className="w-6 h-6 text-gray-800 "
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                fill="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm5.757-1a1 1 0 1 0 0 2h8.486a1 1 0 1 0 0-2H7.757Z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </div>

                                    <div
                                        id="field5"
                                        className="flex items-center hidden mb-2"
                                    >
                                        <input
                                            id="emp5"
                                            type="text"
                                            pattern="[A-Za-z\s]+"
                                            name="name"
                                            className="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     "
                                            placeholder="Employee name"
                                        />
                                        <button
                                            type="button"
                                            className="ml-2"
                                            onclick="removeField(5)"
                                        >
                                            <svg
                                                className="w-6 h-6 text-gray-800 "
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                fill="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm5.757-1a1 1 0 1 0 0 2h8.486a1 1 0 1 0 0-2H7.757Z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div
                                    id="add-btn-container"
                                    className="flex items-center justify-center"
                                >
                                    <button
                                        id="add-desig"
                                        type="button"
                                        onclick="addField()"
                                    >
                                        <svg
                                            className="w-6 h-6 text-gray-800 "
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            fill="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </div>

                                <div className="">
                                    <label
                                        for="date-join"
                                        className="block mb-2 text-sm font-medium text-gray-900 "
                                    >
                                        Date
                                    </label>
                                    <div className="relative w-full">
                                        <div className="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg
                                                className="w-4 h-4 text-blue-900 "
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                            </svg>
                                        </div>
                                        <input
                                            id="date-picker"
                                            datepicker
                                            datepicker-autohide
                                            datepicker-buttons
                                            datepicker-autoselect-today
                                            type="text"
                                            className="bg-gray-100 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5"
                                            placeholder="Select date"
                                            required=""
                                        />
                                    </div>
                                </div>
                                <div className="grid gap-4 grid-cols-2">
                                    <div className="">
                                        <label
                                            for="joining-letter"
                                            className="block mr-8 mb-2 text-sm font-medium text-gray-900 "
                                        >
                                            Activity
                                        </label>
                                        <select
                                            id="extension"
                                            className="select-validate bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     "
                                        >
                                            <option value="male">
                                                Activity 1
                                            </option>
                                        </select>
                                    </div>
                                    <div className="">
                                        <label
                                            for="empID"
                                            className="block mb-2 text-sm font-medium text-gray-900 "
                                        >
                                            Hours Worked
                                        </label>
                                        <input
                                            type="number"
                                            min="0"
                                            name="hoursWorked"
                                            id="hoursWorked"
                                            className="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     "
                                            placeholder=""
                                            required
                                            oninput="validateHours()"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div className="mt-8 flex items-center justify-center">
                                <button
                                    type="submit"
                                    className="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                >
                                    Calculate
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div className="relative p-4 w-full  max-h-full">
                <div className="relative bg-white border border-gray-300 rounded-lg shadow ">
                    <div className="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                        <h3 className="text-lg font-semibold text-gray-900 ">
                            Manual Adjustment
                        </h3>
                    </div>
                    <form className="p-4 md:p-5">
                        <div className="grid gap-4 mb-4">
                            <div id="employeeIDFields" className="">
                                <label
                                    for="empID"
                                    className="block mb-2 text-sm font-medium text-gray-900 "
                                >
                                    Employee Name
                                </label>

                                <div
                                    id="empIDField1"
                                    className="flex items-center mb-2"
                                >
                                    <input
                                        id="empID1"
                                        type="text"
                                        pattern="[A-Za-z\s]+"
                                        name="name"
                                        className="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     "
                                        placeholder="Employee name"
                                        required=""
                                    />
                                </div>

                                <div
                                    id="empIDField2"
                                    className="flex items-center hidden mb-2"
                                >
                                    <input
                                        id="empID2"
                                        type="text"
                                        pattern="[A-Za-z\s]+"
                                        name="name"
                                        className="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     "
                                        placeholder="Employee name"
                                    />
                                    <button
                                        type="button"
                                        className="ml-2 text-red-500"
                                        onclick="removeIDField(2)"
                                    >
                                        <svg
                                            className="w-6 h-6 text-gray-800 "
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            fill="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm5.757-1a1 1 0 1 0 0 2h8.486a1 1 0 1 0 0-2H7.757Z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </div>

                                <div
                                    id="empIDField3"
                                    className="flex items-center hidden mb-2"
                                >
                                    <input
                                        id="empID3"
                                        type="text"
                                        pattern="[A-Za-z\s]+"
                                        name="name"
                                        className="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     "
                                        placeholder="Employee name"
                                    />
                                    <button
                                        type="button"
                                        className="ml-2 text-red-500"
                                        onclick="removeIDField(3)"
                                    >
                                        <svg
                                            className="w-6 h-6 text-gray-800 "
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            fill="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm5.757-1a1 1 0 1 0 0 2h8.486a1 1 0 1 0 0-2H7.757Z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </div>

                                <div
                                    id="empIDField4"
                                    className="flex items-center hidden mb-2"
                                >
                                    <input
                                        id="empID4"
                                        type="text"
                                        pattern="[A-Za-z\s]+"
                                        name="name"
                                        className="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     "
                                        placeholder="Employee name"
                                    />
                                    <button
                                        type="button"
                                        className="ml-2 text-red-500"
                                        onclick="removeIDField(4)"
                                    >
                                        <svg
                                            className="w-6 h-6 text-gray-800 "
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            fill="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm5.757-1a1 1 0 1 0 0 2h8.486a1 1 0 1 0 0-2H7.757Z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </div>

                                <div
                                    id="empIDField5"
                                    className="flex items-center hidden mb-2"
                                >
                                    <input
                                        id="empID5"
                                        type="text"
                                        pattern="[A-Za-z\s]+"
                                        name="name"
                                        className="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     "
                                        placeholder="Employee name"
                                    />
                                    <button
                                        type="button"
                                        className="ml-2 text-red-500"
                                        onclick="removeIDField(5)"
                                    >
                                        <svg
                                            className="w-6 h-6 text-gray-800 "
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            fill="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm5.757-1a1 1 0 1 0 0 2h8.486a1 1 0 1 0 0-2H7.757Z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div
                                id="addIDBtnContainer"
                                className="flex items-center justify-center"
                            >
                                <button
                                    id="addIDButton"
                                    type="button"
                                    onclick="addIDField()"
                                >
                                    <svg
                                        className="w-6 h-6 text-gray-800 "
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </div>

                            <div className="">
                                <label
                                    for=""
                                    className="block mb-2 text-sm font-medium text-gray-900 "
                                >
                                    Adjustment Reason
                                </label>
                                <textarea
                                    type="text"
                                    pattern="[A-Za-z\s]+"
                                    id="comment"
                                    className="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-100 text-base focus:ring-blue-500 focus:border-blue-500     "
                                ></textarea>
                            </div>

                            <div className="">
                                <div className="flex mb-1">
                                    <div className="mr-5">
                                        <label
                                            for="empID"
                                            className="block mb-2 text-sm font-medium text-gray-900 "
                                        >
                                            Credits:
                                        </label>
                                    </div>

                                    <div className="flex -mt-2">
                                        <div className="flex items-center me-4">
                                            <input
                                                id="inline-2-checkbox"
                                                type="checkbox"
                                                value="add"
                                                className="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500  focus:ring-2   single-checkbox"
                                            />
                                            <label
                                                for="inline-2-checkbox"
                                                className="ms-2 text-sm font-medium text-gray-900 "
                                            >
                                                Add
                                            </label>
                                        </div>
                                        <div className="flex items-center me-4">
                                            <input
                                                id="inline-checked-checkbox"
                                                type="checkbox"
                                                value="remove"
                                                className="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500  focus:ring-2   single-checkbox"
                                            />
                                            <label
                                                for="inline-checked-checkbox"
                                                className="ms-2 text-sm font-medium text-gray-900 "
                                            >
                                                Remove
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <p
                                    id="checkbox-error"
                                    className="text-red-600 text-sm hidden"
                                >
                                    Please select either 'Add' or 'Remove'
                                    before saving.
                                </p>
                                <input
                                    type="number"
                                    min="0"
                                    name="hoursWorked"
                                    id="creditAmount"
                                    className="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     "
                                    placeholder=""
                                    required
                                />
                            </div>

                            <div className="mt-8 flex items-center justify-center">
                                <button
                                    type="submit"
                                    className="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                    onclick="validateForm(event)"
                                >
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </>
    );
}
