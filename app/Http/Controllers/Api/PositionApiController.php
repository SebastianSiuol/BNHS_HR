<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Configuration\SchoolPosition;
use Illuminate\Http\Request;

class PositionApiController extends Controller
{
    public function get(){

        $data = SchoolPosition::all(['id', 'title']);

        return response()->json($data);
    }
}
