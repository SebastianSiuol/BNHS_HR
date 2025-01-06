<?php

namespace App\Http\Controllers;

use App\Models\Configuration\RPMSConfiguration;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RPMSConfigurationController extends Controller
{
    public function store(Request $request)
    {
        $get_year_today = Carbon::now()->format('Y');

        // Check if an RPMS configuration exists for the current year
        $rpms = RPMSConfiguration::where('year', $get_year_today)->first();

        if (!$rpms) {
            // Create a new entry if no configuration exists for the current year
            $rpms = new RPMSConfiguration();
            $rpms->year = $get_year_today;
        }

        // Update the mid-year and end-year dates
        $rpms->mid_year_date = $request->mid_year_date;
        $rpms->end_year_date = $request->end_year_date;

        // Save the updated or newly created RPMS configuration
        $rpms->save();

        return redirect()->route('admin.rpms.index')->with('success', 'Submission date updated!');
    }
}
