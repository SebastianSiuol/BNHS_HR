import { z } from 'zod';

export const leaveRequestSchema = z.object({
  leave_type: z.any().optional(),
  start_date: z.string().min(1, { message: "Required" }),
  // reason: z.string().min(15, { message: "Too short!" }),
  no_of_days: z.any().optional(),
  leave_document: z.any().optional(),
});