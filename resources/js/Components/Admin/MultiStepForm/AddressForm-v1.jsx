import { useEffect, useState } from "react";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";

import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";

import { InputSelect } from "@/Components/InputSelect";
import { NavButton } from "@/Components/MultiStepForm/NavButton";
import { LabelInput } from "@/Components/LabelInput";

import { addressDataSchema } from "@/Schemas/MultistepFormSchema";

const FORM_DATA_KEY = "second_form_local_data";

export function AddressForm() {
    const { getSavedData, prevStep, nextStep } = useMultiStepForm();

    const [provinces, setProvinces] = useState([]);
    const [cities, setCities] = useState([]);
    const [barangays, setBarangays] = useState([]);

    const [disableProvince, setDisableProvince] = useState(true);
    const [disableCities, setDisableCities] = useState(true);
    const [disableBarangays, setDisableBarangays] = useState(true);

    const {
        register,
        formState: { errors },
        handleSubmit,
        watch,
        setValue,
    } = useForm({
        resolver: zodResolver(addressDataSchema),
        defaultValues: getSavedData(FORM_DATA_KEY)
    });

    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    const residentialRegion = watch("residential_region");
    const residentialProvince = watch("residential_province");
    const residentialCity = watch("residential_city");

    useEffect(() => {
        async function fetchRegion() {
            if (residentialRegion === "130000000") {
                const metroManila = [
                    {
                        code: "130000000",
                        name: "Metro Manila",
                    },
                ];
                setProvinces(metroManila);
                setDisableProvince(false);
            } else if (residentialRegion !== "0") {
                try {
                    const response = await fetch(
                        `https://psgc.gitlab.io/api/regions/${residentialRegion}/provinces`,);

                    if (response.ok) {
                        const parsedResponse = await response.json();
                        setProvinces(parsedResponse);
                        setDisableProvince(false);
                    } else {
                        console.error(
                            "Error fetching data:",
                            response.statusText
                        );
                        setDisableProvince(true);
                    }
                } catch (err) {
                    console.error("Error fetching data:", err);
                    setDisableProvince(true);
                }
            } else {
                setProvinces([]);
                setCities([]);
                setBarangays([]);
                setDisableProvince(true);
                setDisableCities(true);
                setDisableBarangays(true);
            }
        }
        fetchRegion();
    }, [residentialRegion]);

    useEffect(() => {
        async function fetchProvince() {
            if (residentialProvince === "130000000") {
                try {
                    const response = await fetch(
                        `https://psgc.gitlab.io/api/regions/${residentialProvince}/cities-municipalities`,);

                    if (response.ok) {
                        const parsedResponse = await response.json();
                        setCities(parsedResponse);
                        setDisableCities(false);
                    } else {
                        console.error(
                            "Error fetching data:",
                            response.statusText
                        );
                        setDisableCities(true);
                    }
                } catch (err) {
                    console.error("Error fetching data:", err);
                    setDisableCities(true);
                }
            } else if (residentialProvince !== "0") {
                try {
                    const response = await fetch(
                        `https://psgc.gitlab.io/api/provinces/${residentialProvince}/cities-municipalities`,);

                    if (response.ok) {
                        const parsedResponse = await response.json();
                        setCities(parsedResponse);
                        setDisableCities(false);
                    } else {
                        console.error(
                            "Error fetching data:",
                            response.statusText
                        );
                        setDisableCities(true);
                    }
                } catch (err) {
                    console.error("Error fetching data:", err);
                    setDisableCities(true);
                }
            } else {
                setCities([]);
                setBarangays([]);
                setDisableCities(true);
                setDisableBarangays(true);
            }
        }
        fetchProvince();
    }, [residentialProvince])

    useFetchAddress({
        endpoint: `https://psgc.gitlab.io/api/cities-municipalities/${residentialCity}/barangays`,
        watchValue: residentialCity,
        setValue: setBarangays,
        isLoading: setDisableBarangays,
    });

    function copyAddress(e) {
        e.preventDefault();

        const residentialFields = watch([
            "residential_house_num",
            "residential_street",
            "residential_subdivision",
            "residential_barangay",
            "residential_city",
            "residential_province",
            "residential_zip_code",
        ]);

        // Set permanent fields
        setValue("permanent_house_num", residentialFields[0]);
        setValue("permanent_street", residentialFields[1]);
        setValue("permanent_subdivision", residentialFields[2]);
        setValue("permanent_barangay", residentialFields[3]);
        setValue("permanent_city", residentialFields[4]);
        setValue("permanent_province", residentialFields[5]);
        setValue("permanent_zip_code", residentialFields[6]);
    }

    function onSecondFormSubmit(e) {
        e.preventDefault;
        nextStep();
    }

    return (
        <>
            <form>
                {/* Container */}

                <div className="relative grid grid-cols-none lg:grid-cols-2 gap-16">
                    <button
                        onClick={(e) => copyAddress(e)}
                        className={
                            "absolute right-2 -top-20 my-2 py-1 px-4 bg-blue-600 text-sm font-bold text-white border border-blue-600 rounded-3xl hover:bg-blue-800 hover:text-grey-600 hover:border-blue-800"
                        }
                    >
                        Copy Residential to Permanent
                    </button>

                    <div>
                        <div className="flex items-center">
                            <h6 className="font-semibold">
                                Residential Address
                            </h6>
                        </div>

                        {/* First Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabelInput
                                id={"residential_house_num"}
                                register={register}
                                label={"House/Block/Lot No."}
                                error={errors}
                            />

                            <LabelInput
                                id={"residential_street"}
                                register={register}
                                label={"Street"}
                                error={errors}
                            />
                        </div>

                        {/* Second Row! */}
                        <div>
                            <LabelInput
                                id={"residential_subdivision"}
                                register={register}
                                label={"Subdivision/Village"}
                                error={errors}
                            />
                            <label className={"my-2 space-y-2 text-sm"}>
                                <span>Region</span>
                                <InputSelect
                                    id={"residential_region"}
                                    register={register}
                                >
                                    <option value="0">Select Region</option>
                                    <option value="010000000">Region I</option>
                                    <option value="020000000">Region II</option>
                                    <option value="030000000">
                                        Region III
                                    </option>
                                    <option value="040000000">
                                        Region IV-A
                                    </option>
                                    <option value="170000000">
                                        MIMAROPA Region
                                    </option>
                                    <option value="050000000">Region V</option>
                                    <option value="060000000">Region VI</option>
                                    <option value="070000000">
                                        Region VII
                                    </option>
                                    <option value="080000000">
                                        Region VIII
                                    </option>
                                    <option value="090000000">Region IX</option>
                                    <option value="100000000">Region X</option>
                                    <option value="110000000">Region XI</option>
                                    <option value="120000000">
                                        Region XII
                                    </option>
                                    <option value="130000000">
                                        National Capital Region
                                    </option>
                                    <option value="140000000">
                                        Cordillera Administrative Region
                                    </option>
                                    <option value="160000000">
                                        Region XIII
                                    </option>
                                    <option value="150000000">
                                        Bangsamoro Autonomous Region in Muslim
                                        Mindanao
                                    </option>
                                </InputSelect>
                            </label>
                        </div>

                        {/* Third Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <label className={"my-2 space-y-2 text-sm"}>
                                <span>Province</span>
                                <InputSelect
                                    id={"residential_province"}
                                    register={register}
                                    disabled={disableProvince}
                                    onChange={(e) => {
                                        const selectedCode = e.target.value;
                                        const selectedProvince = provinces.find(
                                            (prov) => prov.code === selectedCode
                                        );
                                        setValue(
                                            "residential_province_name",
                                            selectedProvince?.name || ""
                                        );
                                    }}
                                >
                                    <option value="0">Select Province</option>
                                    {provinces.map((prov) => (
                                        <option
                                            key={prov?.code}
                                            value={prov?.code}
                                        >
                                            {prov?.name}
                                        </option>
                                    ))}
                                </InputSelect>
                            </label>

                            <label className={"my-2 space-y-2 text-sm"}>
                                <span>Municipality/City</span>
                                <InputSelect
                                    id={"residential_city"}
                                    register={register}
                                    disabled={disableCities}
                                    onChange={(e) => {
                                        const selectedCode = e.target.value;
                                        const selectedCity = cities.find(
                                            (city) => city.code === selectedCode
                                        );
                                        setValue(
                                            "residential_city_name",
                                            selectedCity?.name || ""
                                        );
                                    }}
                                >
                                    <option value="0">Select City</option>
                                    {cities.map((city) => (
                                        <option
                                            key={city?.code}
                                            value={city?.code}
                                        >
                                            {city?.name}
                                        </option>
                                    ))}
                                </InputSelect>
                            </label>
                        </div>

                        {/* Fourth Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <label className={"my-2 space-y-2 text-sm"}>
                                <span>Barangays</span>
                                <InputSelect
                                    id={"residential_barangay"}
                                    register={register}
                                    disabled={disableBarangays}
                                    onChange={(e) => {
                                        const selectedCode = e.target.value;
                                        const selectedBarangay = barangays.find(
                                            (barangay) => barangay.code === selectedCode
                                        );
                                        setValue(
                                            "residential_barangay_name",
                                            selectedBarangay?.name || ""
                                        );
                                    }}
                                >
                                    <option value="0">Select Barangay</option>
                                    {barangays.map((barangay) => (
                                        <option
                                            key={barangay?.code}
                                            value={barangay?.code}
                                        >
                                            {barangay?.name}
                                        </option>
                                    ))}
                                </InputSelect>
                            </label>
                            <LabelInput
                                id={"residential_zip_code"}
                                register={register}
                                label={"Zip Code"}
                                error={errors}
                            />
                        </div>
                    </div>

                    <div>
                        <div className="flex items-center">
                            <h6 className="font-semibold">Permanent Address</h6>
                        </div>

                        {/* First Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabelInput
                                id={"permanent_house_num"}
                                register={register}
                                label={"House/Block/Lot No."}
                                error={errors}
                            />

                            <LabelInput
                                id={"permanent_street"}
                                register={register}
                                label={"Street"}
                                error={errors}
                            />
                        </div>

                        {/* Second Row! */}
                        <div>
                            <LabelInput
                                id={"permanent_subdivision"}
                                register={register}
                                label={"Subdivision/Village"}
                                error={errors}
                            />
                            <label className={"my-2 space-y-2 text-sm"}>
                                <span>Region</span>
                                <InputSelect
                                    id={"permanent_region"}
                                    register={register}
                                >
                                    <option value="0">Select Region</option>
                                    <option value="010000000">Region I</option>
                                    <option value="020000000">Region II</option>
                                    <option value="030000000">
                                        Region III
                                    </option>
                                    <option value="040000000">
                                        Region IV-A
                                    </option>
                                    <option value="170000000">
                                        MIMAROPA Region
                                    </option>
                                    <option value="050000000">Region V</option>
                                    <option value="060000000">Region VI</option>
                                    <option value="070000000">
                                        Region VII
                                    </option>
                                    <option value="080000000">
                                        Region VIII
                                    </option>
                                    <option value="090000000">Region IX</option>
                                    <option value="100000000">Region X</option>
                                    <option value="110000000">Region XI</option>
                                    <option value="120000000">
                                        Region XII
                                    </option>
                                    <option value="130000000">
                                        National Capital Region
                                    </option>
                                    <option value="140000000">
                                        Cordillera Administrative Region
                                    </option>
                                    <option value="160000000">
                                        Region XIII
                                    </option>
                                    <option value="150000000">
                                        Bangsamoro Autonomous Region in Muslim
                                        Mindanao
                                    </option>
                                </InputSelect>
                            </label>
                        </div>

                        {/* Third Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <label className={"my-2 space-y-2 text-sm"}>
                                <span>Province</span>
                                <InputSelect
                                    id={"permanent_province"}
                                    register={register}
                                    disabled={disableProvince}
                                >
                                    <option value="0">Select Province</option>
                                    {provinces.map((prov) => (
                                        <option
                                            key={prov?.code}
                                            value={prov?.code}
                                        >
                                            {prov?.name}
                                        </option>
                                    ))}
                                </InputSelect>
                            </label>

                            <label className={"my-2 space-y-2 text-sm"}>
                                <span>Municipality/City</span>
                                <InputSelect
                                    id={"permanent_city"}
                                    register={register}
                                    disabled={disableCities}
                                >
                                    <option value="0">Select City</option>
                                    {cities.map((city) => (
                                        <option
                                            key={city?.code}
                                            value={city?.code}
                                        >
                                            {city?.name}
                                        </option>
                                    ))}
                                </InputSelect>
                            </label>
                        </div>

                        {/* Fourth Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <label className={"my-2 space-y-2 text-sm"}>
                                <span>Barangays</span>
                                <InputSelect
                                    id={"permanent_barangay"}
                                    register={register}
                                    disabled={disableBarangays}
                                >
                                    <option value="0">Select Barangay</option>
                                    {barangays.map((barangay) => (
                                        <option
                                            key={barangay?.code}
                                            value={barangay?.code}
                                        >
                                            {barangay?.name}
                                        </option>
                                    ))}
                                </InputSelect>
                            </label>
                            <LabelInput
                                id={"permanent_zip_code"}
                                register={register}
                                label={"Zip Code"}
                                error={errors}
                            />
                        </div>
                    </div>
                </div>
                <div className={"flex justify-between mt-8"}>
                    <NavButton type={"prev"} onClick={prevStep}>
                        Back
                    </NavButton>
                    <NavButton
                        type={"next"}
                        onClick={handleSubmit(onSecondFormSubmit)}
                    >
                        Next: Account
                    </NavButton>
                </div>
            </form>
        </>
    );
}

function useFetchAddress({
    endpoint,
    watchValue,
    setValue,
    isLoading,
    isRegion = false,
}) {
    useEffect(() => {
        async function fetchData() {
            console.log('test fetch')
            if (watchValue !== "0") {
                try {
                    const response = await fetch(endpoint, {
                        method: "GET",
                    });

                    if (response.ok) {
                        const parsedResponse = await response.json();
                        setValue(parsedResponse);
                        isLoading(false);
                    } else {
                        console.error(
                            "Error fetching data:",
                            response.statusText
                        );
                        isLoading(true);
                    }
                } catch (err) {
                    console.error("Error fetching data:", err);
                    isLoading(true);
                }
            } else {
                setValue([]);
                isLoading(true);
            }
        }

        fetchData();
    }, [watchValue]);
}
