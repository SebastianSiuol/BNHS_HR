<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OtherInformationController extends Controller
{
    public function update(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'otherInformation' => 'required|array|min:1',
            'otherInformation.*.publicId' => 'nullable',
            'otherInformation.*.specialSkills' => 'required|string|max:255',
            'otherInformation.*.distinctions' => 'nullable|string|max:255',
            'otherInformation.*.memberships' => 'nullable|string|max:255',
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
            $otherInformation = collect($validated['otherInformation']);
            $existingIds = $otherInformation->pluck('publicId')->filter();

            $personalInfo = $user->personal_information;

            // Delete records that are not in the current input (ensure UUIDs are handled)
            $personalInfo->other_information()
                ->whereNotIn('public_id', $existingIds)
                ->delete();

            // Update or create other information records
            foreach ($otherInformation as $info) {
                $personalInfo->other_information()->updateOrCreate(
                    ['public_id' => $info['publicId'],],
                    [
                        'special_skills' => $info['specialSkills'],
                        'distinctions' => $info['distinctions'],
                        'memberships' => $info['memberships'],
                    ]
                );
            }
        });

        return redirect()->back()->with(['success' => 'Other information updated successfully.']);
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

        // Get other information records
        $otherInformation = $user->personal_information->other_information;

        // Check if records exist
        if ($otherInformation->isEmpty()) {
            return response()->json([
                'message' => 'No other information records found.'
            ], 404);
        }

        // Map records to an array format
        $mappedRecords = $otherInformation->map(function ($info) {
            return [
                'publicId' => $info->public_id,
                'specialSkills' => $info->special_skills,
                'distinctions' => $info->distinctions,
                'memberships' => $info->memberships,
            ];
        });

        // Return the mapped records
        return response()->json($mappedRecords);
    }
}
