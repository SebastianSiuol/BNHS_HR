<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\PersonalInformation\PersonalInformation;
use App\Models\EducationalBackground;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationalBackgroundController extends Controller
{
    public function get()
    {
        $personalInformation = Auth::user()->personal_information;

        // Retrieve educational background data and format it
        $educBackground = [
            'elementary' => $personalInformation->educational_backgrounds()
                ->where('education_level', 'elementary')
                ->first()
                ?->only([
                    'public_id',
                    'name_of_school',
                    'basic_education_degree_course',
                    'from_date',
                    'to_date',
                    'highest_level_earned',
                    'year_graduated',
                    'scholarships_academic_honors',
                ]),
            'secondary' => $personalInformation->educational_backgrounds()
                ->where('education_level', 'secondary')
                ->first()
                ?->only([
                    'public_id',
                    'name_of_school',
                    'basic_education_degree_course',
                    'from_date',
                    'to_date',
                    'highest_level_earned',
                    'year_graduated',
                    'scholarships_academic_honors',
                ]),
            'vocational' => $personalInformation->educational_backgrounds()
                ->where('education_level', 'vocational')
                ->first()
                ?->only([
                    'public_id',
                    'name_of_school',
                    'basic_education_degree_course',
                    'from_date',
                    'to_date',
                    'highest_level_earned',
                    'year_graduated',
                    'scholarships_academic_honors',
                ]),
            'college' => $personalInformation->educational_backgrounds()
                ->where('education_level', 'college')
                ->first()
                ?->only([
                    'public_id',
                    'name_of_school',
                    'basic_education_degree_course',
                    'from_date',
                    'to_date',
                    'highest_level_earned',
                    'year_graduated',
                    'scholarships_academic_honors',
                ]),
            'graduate' => $personalInformation->educational_backgrounds()
                ->where('education_level', 'graduate')
                ->first()
                ?->only([
                    'public_id',
                    'name_of_school',
                    'basic_education_degree_course',
                    'from_date',
                    'to_date',
                    'highest_level_earned',
                    'year_graduated',
                    'scholarships_academic_honors',
                ]),
        ];

        return response()->json($educBackground);
    }


    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'public_id' => 'nullable|uuid',
            'name_of_school' => 'required|string|max:255',
            'basic_education_degree_course' => 'nullable|string|max:255',
            'from_date' => 'required|date|before_or_equal:today',
            'to_date' => 'nullable|date|after_or_equal:from_date|before_or_equal:today',
            'highest_level_earned' => 'nullable|string|max:255',
            'year_graduated' => 'nullable|string|max:4',
            'scholarships_academic_honors' => 'nullable|string|max:255',
            'category' => 'required|in:elementary,secondary,vocational,college,graduate',
        ]);

        $personalInfoId = Auth::user()->personal_information->id;

        $category = $validatedData['category'];

        EducationalBackground::updateOrCreate(
            [
                'public_id' => $validatedData['public_id'],
                'education_level' => $category,
            ],
            [
                'name_of_school' => $validatedData['name_of_school'],
                'basic_education_degree_course' => $validatedData['basic_education_degree_course'],
                'from_date' => $validatedData['from_date'],
                'to_date' => $validatedData['to_date'],
                'highest_level_earned' => $validatedData['highest_level_earned'],
                'year_graduated' => $validatedData['year_graduated'],
                'scholarships_academic_honors' => $validatedData['scholarships_academic_honors'],
                'personal_information_id' => $personalInfoId,
            ]
        );

        return redirect()->back()->with([
            'success' => 'Educational background updated successfully.',
        ]);
    }
}
