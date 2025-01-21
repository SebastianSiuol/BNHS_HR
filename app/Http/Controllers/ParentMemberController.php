<?php

namespace App\Http\Controllers;

use App\Models\ParentMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ParentMemberController extends Controller
{

    public function get()
    {
        $faculty = Auth::user();

        if (!$faculty || !$faculty->personal_information) {
            return response()->json([
                'message' => 'Personal information not found for the authenticated user.'
            ], 404);
        }

        $personalInformation = $faculty->personal_information;

        $parentMembers = $personalInformation->parent_members()
            ->whereIn('relationship_type', ['father', 'mother'])
            ->get();

        if ($parentMembers->isEmpty()) {
            return response()->json([
                'message' => 'No parent members found with the specified relationship types.'
            ], 404);
        }

        // Structure the response
        $parent = [
            'father' => $parentMembers->firstWhere('relationship_type', 'father')
                ? [
                    'publicId' => $parentMembers->firstWhere('relationship_type', 'father')->public_id,
                    'firstName' => $parentMembers->firstWhere('relationship_type', 'father')->first_name,
                    'middleName' => $parentMembers->firstWhere('relationship_type', 'father')->middle_name,
                    'lastName' => $parentMembers->firstWhere('relationship_type', 'father')->last_name,
                    'nameExtensionId' => $parentMembers->firstWhere('relationship_type', 'father')->name_extension_id
                ] : null,
            'mother' => $parentMembers->firstWhere('relationship_type', 'mother')
                ? [
                    'publicId' => $parentMembers->firstWhere('relationship_type', 'mother')->public_id,
                    'firstName' => $parentMembers->firstWhere('relationship_type', 'mother')->first_name,
                    'middleName' => $parentMembers->firstWhere('relationship_type', 'mother')->middle_name,
                    'lastName' => $parentMembers->firstWhere('relationship_type', 'mother')->last_name,
                    'maidenName' => $parentMembers->firstWhere('relationship_type', 'mother')->maiden_name,
                ] : null,
        ];

        return response()->json($parent);
    }

    public function update(Request $request)
    {
        $request->validate([
            "father_first_name" => "nullable|min:3",
            "father_middle_name" => "nullable|min:3",
            "father_last_name" => "nullable|min:3",
            "father_name_extension_id" => "required",
            "mother_maiden_name" => "nullable|min:3",
            "mother_first_name" => "nullable|min:3",
            "mother_middle_name" => "nullable|min:3",
            "mother_last_name" => "nullable|min:3",
        ], [
            "father_first_name.min" => 'Father\'s first name requires atleast 3 letters.',
            "father_middle_name" => 'Father\'s middle name requires atleast 3 letters.',
            "father_last_name" => 'Father\'s last name requires atleast 3 letters.',
            "father_name_extension_id.required" => 'Name extension is required! Select None if not applicable.',
            "mother_maiden_name" => 'Mother\'s maiden name requires atleast 3 letters.',
            "mother_first_name" => 'Mother\'s first name requires atleast 3 letters.',
            "mother_middle_name" => 'Mother\'s middle name requires atleast 3 letters.',
            "mother_last_name" => 'Mother\'s last name requires atleast 3 letters.',
        ]);

        $personalInformation = Auth::user()->personal_information;

        // Handle Father
        ParentMember::updateOrCreate(
            ['public_id' => $request->father_public_id],
            [
                'personal_information_id' => $personalInformation->id,
                'first_name' => $request->father_first_name,
                'middle_name' => $request->father_middle_name,
                'last_name' => $request->father_last_name,
                'name_extension_id' => $request->father_name_extension_id,
                'relationship_type' => 'father',
            ]
        );

        // Handle Mother
        ParentMember::updateOrCreate(
            ['public_id' => $request->mother_public_id],
            [
                'personal_information_id' => $personalInformation->id,
                'first_name' => $request->mother_first_name,
                'middle_name' => $request->mother_middle_name,
                'last_name' => $request->mother_last_name,
                'maiden_name' => $request->mother_maiden_name,
                'name_extension_id' => 1,
                'relationship_type' => 'mother',
            ]
        );

        return redirect()->back()->with([
            'success' => 'Parent members have been updated successfully!'
        ]);
    }
}
