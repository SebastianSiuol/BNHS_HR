import { useEffect, useState } from "react";
import { useForm } from "react-hook-form";

import { InputSelect } from "@/Components/InputSelect";
import { LabelInput } from "@/Components/LabelInput";

export function AddressFields({
    title,
    prefix,
    register,
    watch,
    setValue,
    errors,
    disabled = false,
}) {
    const [provinces, setProvinces] = useState([]);
    const [cities, setCities] = useState([]);
    const [barangays, setBarangays] = useState([]);

    const [disableProvince, setDisableProvince] = useState(true);
    const [disableCities, setDisableCities] = useState(true);
    const [disableBarangays, setDisableBarangays] = useState(true);

    const selectedRegion = watch(`${prefix}_region`);
    const selectedProvince = watch(`${prefix}_provinceCode`);
    const selectedCity = watch(`${prefix}_cityCode`);
    const selectedBarangay = watch(`${prefix}_barangayCode`);

    useEffect(() => {
        const fetchProvinceController = new AbortController();
        const fetchProvinceSignal = fetchProvinceController.signal;

        async function fetchProvinces() {
            if (selectedRegion === "130000000") {
                const metroManila = [
                    {
                        code: "130000000",
                        name: "Metro Manila",
                    },
                ];
                setProvinces(metroManila);
                setDisableProvince(false);
            } else if (selectedRegion !== "default") {
                try {
                    const response = await fetch(
                        `https://psgc.gitlab.io/api/regions/${selectedRegion}/provinces.json`,
                        {
                            fetchProvinceSignal,
                        }
                    );

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
                resetAllSelects();
            }
        }
        fetchProvinces();
        return () => {
            fetchProvinceController.abort();
            resetAllSelects();
        };
    }, [selectedRegion]);

    useEffect(() => {
        const fetchCitiesController = new AbortController();
        const fetchCitiesSignal = fetchCitiesController.signal;
        handleSelectName(selectedProvince, provinces, `${prefix}_provinceName`);

        async function fetchCities() {
            if (selectedProvince !== "default") {
                const apiUrl =
                    selectedProvince === "130000000"
                        ? `https://psgc.gitlab.io/api/regions/${selectedProvince}/cities-municipalities.json`
                        : `https://psgc.gitlab.io/api/provinces/${selectedProvince}/cities-municipalities.json`;

                try {
                    const response = await fetch(apiUrl, { fetchCitiesSignal });

                    if (!response.ok) {
                        console.error(
                            "Error fetching data:",
                            response.statusText
                        );
                    }

                    const parsedResponse = await response.json();

                    if (parsedResponse) {
                        setCities(parsedResponse);
                        setDisableCities(false);
                    } else {
                        setDisableCities(true);
                    }
                } catch (err) {
                    console.error("Error fetching data:", err);
                    return null;
                }
            } else {
                resetAllSelects({ resetProvinces: false });
            }
        }
        fetchCities();
        return () => {
            fetchCitiesController.abort();
            resetAllSelects({ resetProvinces: false });
        };
    }, [selectedProvince, provinces]);

    useEffect(() => {
        // Create an AbortController to manage fetch cancellation
        const fetchBarangayController = new AbortController();
        const fetchBarangaySignal = fetchBarangayController.signal;

        // Update state or perform side effects based on the selected city
        handleSelectName(selectedCity, cities, `${prefix}_cityName`);

        async function fetchBarangays() {
            if (selectedCity !== "default") {
                try {
                    // Fetch barangays for the selected city
                    const response = await fetch(
                        `https://psgc.gitlab.io/api/cities-municipalities/${selectedCity}/barangays.json`,
                        { signal: fetchBarangaySignal } // Pass the abort signal
                    );

                    if (response.ok) {
                        // Parse and set the barangays data
                        const parsedResponse = await response.json();
                        setBarangays(parsedResponse);
                        setDisableBarangays(false);
                    } else {
                        // Handle non-OK responses
                        console.error(
                            "Error fetching data:",
                            response.statusText
                        );
                        setDisableBarangays(true);
                    }
                } catch (err) {
                    // Handle fetch errors (e.g., network issues, aborts)
                    console.error("Error fetching data:", err);
                    setDisableBarangays(true);
                }
            } else {
                // Reset selects if the default city is selected
                resetAllSelects({ resetProvinces: false, resetCities: false });
            }
        }

        // Call the fetchBarangays function
        fetchBarangays();

        // Cleanup function to abort fetch and reset selects
        return () => {
            fetchBarangayController.abort();
            resetAllSelects({ resetProvinces: false, resetCities: false });
        };
    }, [selectedCity]); // Dependency array ensures this runs when selectedCity changes

    useEffect(() => {
        handleSelectName(selectedBarangay, barangays, `${prefix}_barangayName`);

        return () => {
            resetAllSelects({
                resetProvinces: false,
                resetCities: false,
                resetBarangays: false,
            });
        };
    }, [selectedBarangay]);

    useEffect(() => {
      setValue(`permanent_barangayName`, "");
      setValue(`permanent_houseNumber`, "")
      setValue(`permanent_street`, "")
      setValue(`permanent_subdivision`, "")
      setValue(`permanent_region`, "default")
      setValue(`permanent_provinceCode`, "default")
      setValue(`permanent_cityCode`, "default")
      setValue(`permanent_barangayCode`, "default")
      setValue(`permanent_zipCode`, "")

    }, [disabled])


    function resetAllSelects({
        resetProvinces = true,
        resetCities = true,
        resetBarangays = true,
    } = {}) {
        if (resetProvinces) {
            setProvinces([]);
            setDisableProvince(true);
            setValue(`${prefix}_provinceCode`, "default");
        }

        if (resetCities) {
            setCities([]);
            setDisableCities(true);
            setValue(`${prefix}_cityCode`, "default");
        }

        if (resetBarangays) {
            setBarangays([]);
            setDisableBarangays(true);
            setValue(`${prefix}_barangayCode`, "default");
        }
    }

    function handleSelectName(selectedCode, dataList, valueName) {
        const selectedData = dataList.find(
            (data) => data.code === selectedCode
        );
        setValue(valueName, selectedData?.name || "");
    }

    return (
        <>
            <form>
                <div>
                    <div className="flex items-center">
                        <h6 className="font-semibold">{title}</h6>
                    </div>

                    {/* First Row! */}
                    <div className="mt-2 grid gap-4 grid-cols-2">
                        <LabelInput
                            id={`${prefix}_houseNumber`}
                            register={register}
                            label={"House/Block/Lot No."}
                            error={errors}
                            disabled={disabled}
                        />

                        <LabelInput
                            id={`${prefix}_street`}
                            register={register}
                            label={"Street"}
                            error={errors}
                            disabled={disabled}
                        />
                    </div>

                    {/* Second Row! */}
                    <div>
                        <LabelInput
                            id={`${prefix}_subdivision`}
                            register={register}
                            label={"Subdivision/Village"}
                            error={errors}
                            disabled={disabled}
                        />

                        <label className={"my-2 space-y-2 text-sm"}>
                            <span>Region</span>
                            <InputSelect
                                id={`${prefix}_region`}
                                register={register}
                                error={errors}
                              disabled={disabled}
                            >
                                <option value="default">Select Region</option>
                                <option value="010000000">Region I</option>
                                <option value="020000000">Region II</option>
                                <option value="030000000">Region III</option>
                                <option value="040000000">Region IV-A</option>
                                <option value="170000000">
                                    MIMAROPA Region
                                </option>
                                <option value="050000000">Region V</option>
                                <option value="060000000">Region VI</option>
                                <option value="070000000">Region VII</option>
                                <option value="080000000">Region VIII</option>
                                <option value="090000000">Region IX</option>
                                <option value="100000000">Region X</option>
                                <option value="110000000">Region XI</option>
                                <option value="120000000">Region XII</option>
                                <option value="130000000">
                                    National Capital Region
                                </option>
                                <option value="140000000">
                                    Cordillera Administrative Region
                                </option>
                                <option value="160000000">Region XIII</option>
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
                                id={`${prefix}_provinceCode`}
                                register={register}
                                disabled={disableProvince}
                                error={errors}
                            >
                                <option value="default">Select Province</option>
                                {provinces.map((prov) => (
                                    <option key={prov?.code} value={prov?.code}>
                                        {prov?.name}
                                    </option>
                                ))}
                            </InputSelect>
                        </label>

                        <label className={"my-2 space-y-2 text-sm"}>
                            <span>Municipality/City</span>
                            <InputSelect
                                id={`${prefix}_cityCode`}
                                register={register}
                                disabled={disableCities}
                                error={errors}
                            >
                                <option value="default">Select City</option>
                                {cities.map((city) => (
                                    <option key={city?.code} value={city?.code}>
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
                                id={`${prefix}_barangayCode`}
                                register={register}
                                disabled={disableBarangays}
                                error={errors}
                            >
                                <option value="default">Select Barangay</option>
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
                            id={`${prefix}_zipCode`}
                            register={register}
                            label={"Zip Code"}
                            error={errors}
                            disabled={disabled}
                        />
                    </div>
                </div>
            </form>
        </>
    );
}
