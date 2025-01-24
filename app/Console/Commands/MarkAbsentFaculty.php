<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Faculty;
use App\Models\Attendance;
use App\Models\Shift;
use Carbon\Carbon;

class MarkAbsentFaculty extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mark-absent-faculty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        // Get all shifts that have already ended today
        $shifts = Shift::all();

        foreach ($shifts as $shift) {
            // Parse shift start and end times for today
            $shiftStart = Carbon::parse($shift->from)->setDate($now->year, $now->month, $now->day);
            $shiftEnd = Carbon::parse($shift->to)->setDate($now->year, $now->month, $now->day);

            // Only process shifts that have ended
            if ($shiftEnd->lt($now)) {
                // Get faculties assigned to this shift
                $faculties = Faculty::where('shift_id', $shift->id)->get();

                foreach ($faculties as $faculty) {
                    // Check if attendance exists for this faculty and shift
                    $attendance = Attendance::where('faculty_id', $faculty->id)
                        ->whereDate('created_at', $shiftStart->toDateString())
                        ->whereBetween('created_at', [$shiftStart, $shiftEnd])
                        ->first();

                    if (!$attendance) {
                        // Mark as absent if no attendance exists for the shift
                        Attendance::create([
                            'faculty_id' => $faculty->id,
                            'check_in' => null,
                            'check_out' => null,
                            'status' => 'absent',
                        ]);
                    }
                }
            }
        }

        $this->info('Absent records updated for past shifts.');
    }
}
