<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Leave extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['leave_types', 'faculty.personal_information'];

    protected static function boot() : void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->public_id)) {
                $model->public_id = (string) Str::uuid();
            }
        });
    }

    public function totalLeaveDays()
    {

        $startDate = Carbon::createFromFormat('Y-m-d', $this->start_date);
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


    public static function isThereLeaveActive()
    {
        $user = Auth::user();

        $leave = $user->leaves()->latest()->first();

        if (!$leave) {
            return false;
        }

        $validStatuses = ['pending', 'approved', 'ongoing'];
        if (in_array($leave->status, $validStatuses)) {
            $dateToday = Carbon::now();
            $endDate = Carbon::parse($leave->end_date);

            if ($dateToday->lessThanOrEqualTo($endDate)) {
                return true; // Active leave based on status and date range
            }
        }

        return false; // No active leave
    }


    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function leave_types()
    {
        return $this->belongsTo(LeaveType::class);
    }
}
