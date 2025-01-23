<?php

namespace App\Http\Controllers;

use App\Models\Configuration\RPMSConfiguration;
use App\Models\Faculty;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RPMSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth_faculty = Auth::user();
        $auth_department_id = $auth_faculty->designation->department_id;
        $auth_faculty_roles = $auth_faculty->roles->pluck('role_name');

        $facultiesQuery = Faculty::select('id', 'faculty_code', 'designation_id')
        ->with([
            'personal_information' => fn($query) => $query->select('faculty_id', 'first_name', 'last_name'),
            'designation' => fn($query) => $query->select('id', 'department_id')
            ->with(['department' => fn($deptQuery) => $deptQuery->select('id', 'name')]),
        ]);


        if ($auth_faculty_roles->contains('hr_manager')) {
            $facultiesQuery->whereHas('designation.department', fn($query) => $query->where('id', $auth_department_id));
        }

        $faculties = $facultiesQuery->paginate(5);

        $year_now = Carbon::now()->format('Y');

        $rpms_config = RPMSConfiguration::where('year', $year_now)
            ->select('id', 'mid_year_date', 'end_year_date', 'year')
            ->first();

        return Inertia::render('Admin/RPMS/Index', [
            'faculties' => $faculties,
            'rpmsConfig' => $rpms_config
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
