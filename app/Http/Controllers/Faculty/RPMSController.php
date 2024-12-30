<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Configuration\RPMSConfiguration;
use App\Models\RPMS;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;


class RPMSController extends Controller
{
    public function index(){
        $rpms = RPMS::paginate(5);

        $year_now = Carbon::now()->format('Y');
        $rpms_config = RPMSConfiguration::where('year', $year_now)->select('id', 'mid_year_date', 'end_year_date', 'year')->first();

        return Inertia::render('Faculty/RPMS/Index', [
            'rpms' => $rpms,
            'rpmsConfig' => $rpms_config,
        ]);
    }
}
