<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CivilServiceController extends Controller
{

    public function update(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'civilServices' => 'required|array|min:1',
            'civilServices.*.id' => 'nullable|integer|exists:civil_services,id',
            'civilServices.*.careerService' => 'required|string|max:255',
            'civilServices.*.rating' => 'nullable|numeric|min:0|max:100',
            'civilServices.*.dateOfExamination' => 'required|date|before_or_equal:today',
            'civilServices.*.placeOfExamination' => 'nullable|string|max:255',
            'civilServices.*.licenseNumber' => 'nullable|string|max:255',
            'civilServices.*.dateOfValidity' => 'nullable|date|after_or_equal:dateOfExamination',
        ]);

        $faculty = Auth::user();

        // Ensure the user has personal information available
        if (!$faculty || !$faculty->personal_information) {
            return response()->json([
                'message' => 'Personal information not found for the authenticated user.'
            ], 404);
        }

        // Start a transaction
        DB::transaction(function () use ($validated, $faculty) {
            $civilServices = collect($validated['civilServices']);
            $existingIds = $civilServices->pluck('id')->filter(); // Collect existing IDs only

            // Get the related civil services for the user's personal information
            $personalInfo = $faculty->personal_information;

            // Delete records that are not included in the current input
            $personalInfo->civil_services()
                ->whereNotIn('id', $existingIds)
                ->delete();

            // Update or create civil services
            foreach ($civilServices as $service) {
                $personalInfo->civil_services()->updateOrCreate(
                    ['id' => $service['id'] ?? null], // Match by ID if available
                    [
                        'career_service' => $service['careerService'],
                        'rating' => $service['rating'],
                        'date_of_examination' => $service['dateOfExamination'],
                        'place_of_examination' => $service['placeOfExamination'],
                        'license_number' => $service['licenseNumber'],
                        'date_of_validity' => $service['dateOfValidity'],
                    ]
                );
            }
        });


        return redirect()->back()->with('success', 'Civil service eligiblity updated successfully');
    }

    public function all()
    {
        // Retrieve the authenticated user
        $faculty = Auth::user();

        // Check if the user and personal information exist
        if (!$faculty || !$faculty->personal_information) {
            return response()->json([
                'message' => 'Personal information not found for the authenticated user.'
            ], 404);
        }

        // Get civil services
        $civ_servs = $faculty->personal_information->civil_services;

        // Check if civil services exist
        if ($civ_servs->isEmpty()) {
            return response()->json([
                'message' => 'No civil service records found.'
            ], 404);
        }

        // Map civil services to an array format
        $array_all = $civ_servs->map(function ($civ_serv) {
            return [
                'id' => $civ_serv->id,
                'careerService' => $civ_serv->career_service,
                'rating' => $civ_serv->rating,
                'dateOfExamination' => $civ_serv->date_of_examination,
                'placeOfExamination' => $civ_serv->place_of_examination,
                'licenseNumber' => $civ_serv->license_number,
                'dateOfValidity' => $civ_serv->date_of_validity,
            ];
        });

        // Return the mapped civil services
        return response()->json($array_all);
    }
}
