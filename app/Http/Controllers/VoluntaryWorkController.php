<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VoluntaryWorkController extends Controller
{
    public function update(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'voluntaryWorks' => 'required|array|min:1',
            'voluntaryWorks.*.publicId' => 'required|string|max:255',
            'voluntaryWorks.*.organizationName' => 'required|string|max:255',
            'voluntaryWorks.*.dateFrom' => 'required|date',
            'voluntaryWorks.*.dateTo' => 'nullable|date|after_or_equal:voluntaryWorks.*.dateFrom',
            'voluntaryWorks.*.hours' => 'required|integer|min:0',
            'voluntaryWorks.*.position' => 'required|string|max:255',
        ],
        [
            'voluntaryWorks.required' => 'The work experiences field is required.',
            'voluntaryWorks.*.organizationName.required' => 'An organization name is required.',
            'voluntaryWorks.*.hours.required' => 'The hours worked is required.',
            'voluntaryWorks.*.position.required' => 'The position is required.',
            'voluntaryWorks.*.dateFrom.required' => 'An initial date is required.',
            'voluntaryWorks.*.toDate.after_or_equal' => 'The \'To date\' should not come before \'From date\'.',
        ]);

        $user = Auth::user();

        // Ensure the user has related personal information or other relationships
        if (!$user || !$user->personal_information) {
            return response()->json([
                'message' => 'Personal information not found for the authenticated user.',
            ], 404);
        }

        // Use a transaction for consistency
        DB::transaction(function () use ($validated, $user) {
            $voluntaryWorks = collect($validated['voluntaryWorks']);
            $existingIds = $voluntaryWorks->pluck('publicId')->filter(); // Filter for existing IDs

            $personalInfo = $user->personal_information;

            // Delete records that are not in the current input
            $personalInfo->voluntary_works()
                ->whereNotIn('public_id', $existingIds)
                ->delete();

            // Update or create voluntary works
            foreach ($voluntaryWorks as $work) {
                $personalInfo->voluntary_works()->updateOrCreate(
                    ['id' => $work['publicId']], // Match by ID if available
                    [
                        'organization_name' => $work['organizationName'],
                        'date_from' => $work['dateFrom'],
                        'date_to' => $work['dateTo'],
                        'hours' => $work['hours'],
                        'position' => $work['position'],
                    ]
                );
            }
        });

        return redirect()->back()->with(['success' => 'Voluntary work updated successfully.']);
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

        // Get voluntary works
        $voluntaryWorks = $user->personal_information->voluntary_works;

        // Check if voluntary works exist
        if ($voluntaryWorks->isEmpty()) {
            return response()->json([
                'message' => 'No voluntary work records found.'
            ], 404);
        }

        // Map voluntary works to an array format
        $mappedWorks = $voluntaryWorks->map(function ($work) {
            return [
                'publicId' => $work->public_id,
                'organizationName' => $work->organization_name,
                'dateFrom' => $work->date_from,
                'dateTo' => $work->date_to,
                'hours' => $work->hours,
                'position' => $work->position,
            ];
        });

        // Return the mapped voluntary works
        return response()->json($mappedWorks);
    }
}
