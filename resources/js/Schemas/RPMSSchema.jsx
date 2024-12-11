import { z } from 'zod';

export const setSubmissionDateSchema = z.object({
  mid_year_date: z.string().min(1, { message: "Required" }).date(),
  end_year_date: z.string().min(1, { message: "Required" }).date(),
});