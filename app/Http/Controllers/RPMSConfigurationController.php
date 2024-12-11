<?php

namespace App\Http\Controllers;

use App\Models\Configuration\RPMSConfiguration;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RPMSConfigurationController extends Controller
{
    public function store(Request $request){

        // TODO: Add if there is a new year logic!
        $get_year_today = Carbon::now()->format('Y');

        $rpms = RPMSConfiguration::where('year', $get_year_today)->get()->first();

        $rpms->mid_year_date = $request->mid_year_date;
        $rpms->end_year_date = $request->end_year_date;

        $rpms->save();

        return redirect()->route('admin.rpms.index')->with('success', 'Submission date updated!');

    }
}
