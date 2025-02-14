<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LeaveType extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->public_id)) {
                $model->public_id = (string) Str::uuid();
            }
        });
    }

    public static function calculateLeaveEndDate($startDate, $leaveDays)
    {

        // Parse the start date using Carbon
        $currentDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $daysCounted = 0;

        // Loop until we have counted the desired leave days, excluding weekends
        while ($daysCounted < $leaveDays) {
            // Move to the next day
            $currentDate->addDay();

            // Check if the current day is a weekday (Monday to Friday)
            if ($currentDate->isWeekday()) {
                $daysCounted++;
            }
        }

        // Return the calculated end date as a formatted string
        return $currentDate->toDateString();  // e.g., "2024-10-09"
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
