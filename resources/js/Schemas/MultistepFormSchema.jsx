import { z } from 'zod';


export const personalDataSchema = z.object({
  first_name: z.string().min(1, { message: "Required" }),
  middle_name: z.any().optional(),
  last_name: z.string().min(1, { message: "Required" }),
  name_extension_id: z.any().optional(),

  place_of_birth: z.string().min(1, { message: "Required" }),
  date_of_birth: z.string().min(1, { message: "Required" }),
  sex: z.string().min(1, { message: "Required" }),
  civil_status_id: z.any().optional(),

  contact_number: z.string().min(1, { message: "Required" }),
  telephone_number: z.any().optional(),
  contact_person_name: z.string().min(1, { message: "Required" }),
  contact_person_number: z.string().min(1, { message: "Required" }),
});



export const addressDataSchema = z.object({
  residential_house_num: z.string().min(1, { message: "Required" }),
  residential_street: z.string().min(1, { message: "Required" }),
  residential_subdivision: z.string().min(1, { message: "Required" }),
  residential_barangay: z.string().min(1, { message: "Required" }),
  residential_city: z.string().min(1, { message: "Required" }),
  residential_province: z.string().min(1, { message: "Required" }),
  residential_zip_code: z.string().min(1, { message: "Required" }),
  permanent_house_num: z.string().min(1, { message: "Required" }),
  permanent_street: z.string().min(1, { message: "Required" }),
  permanent_subdivision: z.string().min(1, { message: "Required" }),
  permanent_barangay: z.string().min(1, { message: "Required" }),
  permanent_city: z.string().min(1, { message: "Required" }),
  permanent_province: z.string().min(1, { message: "Required" }),
  permanent_zip_code: z.string().min(1, { message: "Required" }),
});

export const emailDataSchema = z.object({
  email: z
      .string()
      .min(4, { message: "Required" })
      .email({ message: "Must be a valid email!" })
});


export const companyDetailsDataSchema = z.object({

  department_id: z.any().optional(),
  designation_id: z.any().optional(),
  depart_head: z.string(),
  shift_id: z.any().optional(),
  date_of_joining: z.string(),
  position_id: z.any().optional(),
});