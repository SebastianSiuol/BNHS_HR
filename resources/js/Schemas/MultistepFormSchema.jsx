import { z } from 'zod';
import dayjs from "dayjs";

const eighteenYearsAgo = dayjs().subtract(18, "year");


export const personalDataSchema = z.object({
  first_name: z.string().min(1, { message: "Required" }),
  middle_name: z.any().optional(),
  last_name: z.string().min(1, { message: "Required" }),
  name_extension_id: z.any().optional(),

  place_of_birth: z.string().min(1, { message: "Required" }),
  date_of_birth: z.coerce.date(),
  sex: z.string().min(1, { message: "Required" }),
  civil_status_id: z.any().optional(),

  contact_number: z.string().min(1, { message: "Required" }),
  telephone_number: z.any().optional(),
  contact_person_name: z.string().min(1, { message: "Required" }),
  contact_person_number: z.string().min(1, { message: "Required" }),
});


export const addressDataSchema = z.object({
    residential_houseNumber: z.string().min(1, { message: "House/Block/Lot No. is required!" }),
    residential_street: z.string().min(1, { message: "Street is required!" }),
    residential_subdivision: z.string().min(1, { message: "Subdivision is required!" }),
    residential_provinceCode: z
        .string()
        .optional()
        .refine((value) => value !== "default", {
            message: "Please select a province.",
        }),
    residential_cityCode: z
        .string()
        .optional()
        .refine((value) => value !== "default", {
            message: "Please select a City.",
        }),
    residential_barangayCode: z
        .string()
        .optional()
        .refine((value) => value !== "default", {
            message: "Please select a Barangay.",
        }),
    residential_zipCode: z.string().min(1, { message: "Zip Code is required!" }),
});

export const emailDataSchema = z.object({
  email: z
      .string()
      .min(4, { message: "Required" })
      .email({ message: "Must be a valid email!" })
});


export const companyDetailsDataSchema = z.object({
    department_id: z
        .any()
        .optional()
        .refine((value) => value !== "0", {
            message: "Please select a department.",
        }),
    designation_id: z
        .any()
        .optional()
        .refine((value) => value !== "0", {
            message: "Please select a designation.",
        }),
    department_head: z.any().optional(),
    shift_id: z
        .any()
        .optional()
        .refine((value) => value !== "0", {
            message: "Please select a shift.",
        }),
    date_of_joining: z.coerce.date(),

    position_id: z
        .any()
        .optional()
        .refine((value) => value !== "0", {
            message: "Please select a position.",
        }),
});