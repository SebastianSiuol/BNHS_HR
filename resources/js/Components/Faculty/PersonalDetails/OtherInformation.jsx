import { useState, useEffect } from "react";
import { useForm, Controller } from "react-hook-form";
import { usePage, router } from "@inertiajs/react";
import { z } from "zod";

import CustomDatePicker from "@/Components/CustomDatePicker";
import { LabelInput } from "@/Components/LabelInput";
import { InputSelect } from "@/Components/InputSelect";

export function OtherInformation() {
    const {
        register,
        handleSubmit,
        formState: { errors },
        reset,
        control,
    } = useForm();

    return <h1>hey</h1>;
  }