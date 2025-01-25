<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Role;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function index()
    {

        $data = Role::all(['id', 'type', 'description']);

        return Inertia::render('Admin/Config/Role/Index', [
            'retrievedRoles' => $data,
        ]);
    }

    public function update(Request $request, Faculty $faculty)
    {

        $request->validate([
            'roles_id' => 'required|array',
        ], [
            'roles_id.required' => 'Atleast one role is required!',
        ]);

        $roles = $request->roles_id;

        $roles_list = Role::whereIn('id', $roles)->pluck('role_name')->map(fn($role) => strtolower($role));

        if ($roles_list->contains('hr_admin') && $roles_list->contains('hr_manager')) {
            return redirect()
                ->back()
                ->withErrors(['roles_id' => 'Faculty cannot be an Admin and a Manager at the same time.'])
                ->withInput();
        }

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
