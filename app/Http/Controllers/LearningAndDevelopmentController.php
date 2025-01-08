<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LearningAndDevelopmentController extends Controller
{
    public function update(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'learningAndDevelopment' => 'required|array|min:1',
            'learningAndDevelopment.*.id' => 'nullable|integer|exists:learning_and_development,id',
            'learningAndDevelopment.*.title' => 'required|string|max:255',
            'learningAndDevelopment.*.dateFrom' => 'required|date',
            'learningAndDevelopment.*.dateTo' => 'nullable|date|after_or_equal:learningAndDevelopment.*.dateFrom',
            'learningAndDevelopment.*.hours' => 'required|integer|min:0',
            'learningAndDevelopment.*.type' => 'required|string|max:255',
            'learningAndDevelopment.*.conductedBy' => 'required|string|max:255',
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
            $learningAndDevelopment = collect($validated['learningAndDevelopment']);
            $existingIds = $learningAndDevelopment->pluck('id')->filter(); // Filter for existing IDs

            $personalInfo = $user->personal_information;

            // Delete records that are not in the current input
            $personalInfo->learning_and_developments()
                ->whereNotIn('id', $existingIds)
                ->delete();

            // Update or create learning and development records
            foreach ($learningAndDevelopment as $record) {
                $personalInfo->learning_and_developments()->updateOrCreate(
                    ['id' => $record['id'] ?? null], // Match by ID if available
                    [
                        'title' => $record['title'],
                        'date_from' => $record['dateFrom'],
                        'date_to' => $record['dateTo'],
                        'hours' => $record['hours'],
                        'type' => $record['type'],
                        'conducted_by' => $record['conductedBy'],
                    ]
                );
            }
        });

        return response()->json(['message' => 'Learning and development records updated successfully.']);
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

        // Get learning and development records
        $learningAndDevelopment = $user->personal_information->learning_and_developments;

        // Check if records exist
        if ($learningAndDevelopment->isEmpty()) {
            return response()->json([
                'message' => 'No learning and development records found.'
            ], 404);
        }

        // Map records to an array format
        $mappedRecords = $learningAndDevelopment->map(function ($record) {
            return [
                'id' => $record->id,
                'title' => $record->title,
                'dateFrom' => $record->date_from,
                'dateTo' => $record->date_to,
                'hours' => $record->hours,
                'type' => $record->type,
                'conductedBy' => $record->conducted_by,
            ];
        });

        // Return the mapped records
        return response()->json($mappedRecords);
    }
}
