import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { LabeledInput } from "@/Components/LabeledInput";

export function CompanyDetailsForm({ prevStep, nextStep, error }) {
    const { data, setData, firstStepFormFinish } = useMultiStepForm();

    function handleChange(event) {
        const { id, value } = event.target;
        setData((data) => ({ ...data, [id]: value }));
    }
    return (
        <>
            <div className="grid grid-cols-none lg:grid-cols-2 gap-16">
                <div>
                    <LabeledInput
                        label={"Faculty Code"}
                        placeholder={"Faculty Code"}
                        color={"black"}
                        width={"normal"}
                        required={true}
                        id={"faculty_code"}
                        error={error?.faculty_code}
                        value={data.faculty_code}
                        onChange={handleChange}
                    />
                    <LabeledInput
                        label={"Designation"}
                        placeholder={"Designation"}
                        color={"black"}
                        width={"normal"}
                        required={true}
                        id={"designation"}
                        error={error?.designation}
                        value={data.designation}
                        onChange={handleChange}
                    />
                    <LabeledInput
                        label={"Manager/Department Head"}
                        placeholder={"Manager/Department Head"}
                        color={"black"}
                        width={"normal"}
                        required={true}
                        id={"depart_head"}
                        error={error?.depart_head}
                        value={data.depart_head}
                        onChange={handleChange}
                    />
                    <LabeledInput
                        label={"Shift"}
                        placeholder={"Shift"}
                        color={"black"}
                        width={"normal"}
                        required={true}
                        id={"shift"}
                        error={error?.shift}
                        value={data.shift}
                        onChange={handleChange}
                    />
                </div>
                <div>
                    <LabeledInput
                        label={"Department"}
                        placeholder={"Department"}
                        color={"black"}
                        width={"normal"}
                        required={true}
                        id={"department"}
                        error={error?.department}
                        value={data.department}
                        onChange={handleChange}
                    />
                    <LabeledInput
                        label={"Date of Joining"}
                        placeholder={"Date of Joining"}
                        color={"black"}
                        width={"normal"}
                        required={true}
                        id={"date_of_joining"}
                        error={error?.date_of_joining}
                        value={data.date_of_joining}
                        onChange={handleChange}
                    />
                    <LabeledInput
                        label={"Position"}
                        placeholder={"Position"}
                        color={"black"}
                        width={"normal"}
                        required={true}
                        id={"position"}
                        error={error?.position}
                        value={data.position}
                        onChange={handleChange}
                    />
                    <LabeledInput
                        label={"Roles"}
                        placeholder={"Roles"}
                        color={"black"}
                        width={"normal"}
                        required={true}
                        id={"roles"}
                        error={error?.roles}
                        value={data.roles}
                        onChange={handleChange}
                    />
                </div>
            </div>
            <div className={"flex justify-between"}>
                <button
                    onClick={prevStep}
                    className={
                        "text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                    }
                >
                    Back
                </button>
                <button
                    onClick={nextStep}
                    className={
                        "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    }
                >
                    Next: Documents
                </button>
            </div>
        </>
    );
}
