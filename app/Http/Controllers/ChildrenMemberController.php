<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChildrenMemberController extends Controller
{
    public function get()
    {
        $faculty = Auth::user();
        $personalInformation = $faculty->personal_information;

        if (!$faculty || !$personalInformation) {
            return response()->json([
                'message' => 'Personal information not found for the authenticated user.'
            ], 404);
        }

        $childrenMembers = $personalInformation->children_members;

        if ($childrenMembers->isEmpty()) {
            return response()->json([
                'message' => 'No other information records found.'
            ], 404);
        }

        $mappedRecords = $childrenMembers->map(function ($child) {
            return [
                'publicId' => $child->public_id,
                'nameOfChild' => $child->name,
                'dateOfBirth' => $child->date_of_birth,
            ];
        });

        // Return the mapped records
        return response()->json($mappedRecords);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'childrenMembers' => 'required|min:1',
            'childrenMembers.*.publicId' => 'nullable',
            'childrenMembers.*.nameOfChild' => 'required|string|max:255',
            'childrenMembers.*.dateOfBirth' => 'required|date',
        ]);

        $faculty = Auth::user();
        $personalInformation = $faculty->personal_information;

        if (!$faculty || !$personalInformation) {
            return response()->json([
                'message' => 'Personal information not found for the authenticated user.',
            ], 404);
        }

        DB::transaction(function () use ($validated, $personalInformation) {
            $children = collect($validated['childrenMembers']);
            $existingIds = $children->pluck('publicId')->filter();

            $personalInformation->children_members()
                ->whereNotIn('public_id', $existingIds)
                ->delete();

            foreach ($children as $child) {
                $personalInformation->children_members()->updateOrCreate(
                    ['public_id' => $child['publicId'],],
                    [
                        'name' => $child['nameOfChild'],
                        'date_of_birth' => $child['dateOfBirth'],
                    ]
                );
            }
        });

        return redirect()->back()->with(['success' => 'Other information updated successfully.']);
    }
}
