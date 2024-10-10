<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['leave_types','faculty.personal_information'];


    public function totalLeaveDays(){

        $startDate = Carbon::createFromFormat('m-d-Y', $this->start_date);
        $endDate = Carbon::createFromFormat('Y-m-d', $this->leave_date);

        $totalDays = 0;

        // Loop through each day from startDate to endDate
        while ($startDate->lte($endDate)) {
            // Check if the current day is not a Saturday (6) or Sunday (0)
            if (!$startDate->isWeekend()) {
                $totalDays++;
            }
            // Move to the next day
            $startDate->addDay();
        }

        return (int) round($totalDays, 0);
    }

    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }

    public function leave_types(){
        return $this->belongsTo(LeaveType::class);
    }
}
