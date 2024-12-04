import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { LabeledInput } from "@/Components/LabeledInput";

export function DocumentForm({ prevStep, error }) {
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
                        label={"Resume File"}
                        placeholder={"Resume File"}
                        color={"black"}
                        width={"normal"}
                        required={true}
                        id={"resume_file"}
                        error={error?.resume_file}
                        value={data.resume_file}
                        onChange={handleChange}
                    />
                    <LabeledInput
                        label={"Joining Letter"}
                        placeholder={"Joining Letter"}
                        color={"black"}
                        width={"normal"}
                        required={true}
                        id={"joining_letter"}
                        error={error?.joining_letter}
                        value={data.joining_letter}
                        onChange={handleChange}
                    />
                    <LabeledInput
                        label={"Dropbox URL"}
                        placeholder={"Dropbox URL"}
                        color={"black"}
                        width={"normal"}
                        required={true}
                        id={"dropbox_url"}
                        error={error?.dropbox_url}
                        value={data.dropbox_url}
                        onChange={handleChange}
                    />
                </div>
                <div>
                    <LabeledInput
                        label={"Resume File"}
                        placeholder={"Resume File"}
                        color={"black"}
                        width={"normal"}
                        required={true}
                        id={"resume_file"}
                        error={error?.resume_file}
                        value={data.resume_file}
                        onChange={handleChange}
                    />
                    <LabeledInput
                        label={"Joining Letter"}
                        placeholder={"Joining Letter"}
                        color={"black"}
                        width={"normal"}
                        required={true}
                        id={"joining_letter"}
                        error={error?.joining_letter}
                        value={data.joining_letter}
                        onChange={handleChange}
                    />
                    <LabeledInput
                        label={"Dropbox URL"}
                        placeholder={"Dropbox URL"}
                        color={"black"}
                        width={"normal"}
                        required={true}
                        id={"dropbox_url"}
                        error={error?.dropbox_url}
                        value={data.dropbox_url}
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
            </div>
        </>
    );
}
