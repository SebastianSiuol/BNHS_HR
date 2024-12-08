<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FacultyAccountInformation\Designation;
use Illuminate\Http\Request;

class DesignationApiController extends Controller
{
    public function getDesignations(Request $request)
    {

        $designations = Designation::with('department')
            ->where('department_id', 'LIKE', $request->department)->get();

        return response()->json($designations);

    }
}
