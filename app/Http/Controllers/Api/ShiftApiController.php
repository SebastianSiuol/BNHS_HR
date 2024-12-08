<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftApiController extends Controller
{
    public function get(){

        $data = Shift::all(['id', 'name']);

        return response()->json($data);
    }
}
