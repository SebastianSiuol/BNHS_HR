<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WorkExperienceController extends Controller
{
    public function update(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'workExperiences' => 'required|array|min:1',
            'workExperiences.*.publicId' => 'nullable',
            'workExperiences.*.fromDate' => 'required|date',
            'workExperiences.*.toDate' => 'nullable|date|after_or_equal:workExperiences.*.fromDate',
            'workExperiences.*.positionTitle' => 'required|string|max:255',
            'workExperiences.*.department' => 'required|string|max:255',
            'workExperiences.*.monthlySalary' => 'required|numeric|min:0',
            'workExperiences.*.salaryGrade' => 'nullable|string|max:50',
            'workExperiences.*.statusOfAppointment' => 'required|string|max:255',
            'workExperiences.*.govService' => 'required|in:yes,no',
        ],[
            'workExperiences.required' => 'The work experiences field is required.',
            'workExperiences.array' => 'The work experiences must be an array.',
            'workExperiences.min' => 'You must provide at least one work experience.',
            'workExperiences.*.toDate.after_or_equal' => 'The \'To date\' should not come before \'From date\'.',
        ]
    );

        $user = Auth::user();

        // Ensure the user has related personal information or other relationships
        if (!$user || !$user->personal_information) {
            return response()->json([
                'message' => 'Personal information not found for the authenticated user.',
            ], 404);
        }

        // Use a transaction for consistency
        DB::transaction(function () use ($validated, $user) {
            $workExperiences = collect($validated['workExperiences']);
            $existingIds = $workExperiences->pluck('publicId')->filter(); // Filter for existing IDs

            $personalInfo = $user->personal_information;

            // Delete records that are not in the current input
            $personalInfo->work_experiences()
                ->whereNotIn('public_id', $existingIds)
                ->delete();

            // Update or create work experiences
            foreach ($workExperiences as $experience) {
                $personalInfo->work_experiences()->updateOrCreate(
                    ['publicId' => $experience['publicId']], // Match by ID if available
                    [
                        'from_date' => $experience['fromDate'],
                        'to_date' => $experience['toDate'],
                        'position_title' => $experience['positionTitle'],
                        'department' => $experience['department'],
                        'monthly_salary' => $experience['monthlySalary'],
                        'salary_grade' => $experience['salaryGrade'],
                        'status_of_appointment' => $experience['statusOfAppointment'],
                        'gov_service' => $experience['govService'],
                    ]
                );
            }
        });

        return redirect()->back()->with('success', 'Work experience updated successfully.');
    }

    public function all()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if the user and personal information exist
        if (!$user || !$user->personal_information) {
            return response()->json([
                'message' => 'Personal information not found for the authenticated user.'
            ], 404);
        }

        // Get work experiences
        $workExperiences = $user->personal_information->work_experiences;

        // Check if work experiences exist
        if ($workExperiences->isEmpty()) {
            return response()->json([
                'message' => 'No work experience records found.'
            ], 404);
        }

        // Map work experiences to an array format
        $mappedExperiences = $workExperiences->map(function ($experience) {
            return [
                'publicId' => $experience->public_id,
                'fromDate' => $experience->from_date,
                'toDate' => $experience->to_date,
                'positionTitle' => $experience->position_title,
                'department' => $experience->department,
                'monthlySalary' => $experience->monthly_salary,
                'salaryGrade' => $experience->salary_grade,
                'statusOfAppointment' => $experience->status_of_appointment,
                'govService' => $experience->gov_service,
            ];
        });

        // Return the mapped work experiences
        return response()->json($mappedExperiences);
    }

}
