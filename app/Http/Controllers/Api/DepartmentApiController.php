<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FacultyAccountInformation\Department;
use Illuminate\Http\Request;

class DepartmentApiController extends Controller
{
    public function get(){

        $data = Department::all(['id', 'name']);

        return response()->json($data);
    }
}
