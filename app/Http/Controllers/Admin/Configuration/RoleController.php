<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Faculty;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function index(){
        return Inertia::render('Admin/Config/Role/Index');
    }

    public function update(Request $request, Faculty $faculty){

        $request->validate([
            'roles_id' => 'required|array',
        ], [
            'roles_id.required' => 'Atleast one role is required!',
        ]);

        $old_roles = $faculty->roles->pluck('id');
        $user_id = $faculty->id;


        $faculty->roles()->detach($old_roles);
        $faculty->roles()->attach($request->roles_id);
        $faculty->save();

        DB::table('sessions')
        ->whereUserId($user_id)
        ->delete();

        return redirect()
        ->route('admin.faculty.index')
        ->with('success', 'Employee updated successfully!');
    }
}
