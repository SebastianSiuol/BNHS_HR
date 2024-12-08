<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleApiController extends Controller
{
    public function get(){

        $data = Role::all(['id', 'type', 'description']);

        return response()->json($data);
    }
}
