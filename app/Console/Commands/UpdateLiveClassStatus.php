<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LiveClass;
use Carbon\Carbon;

class UpdateLiveClassStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'live-class:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update live class status based on scheduled time and duration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        
        // Get all live classes that are not cancelled
        $liveClasses = LiveClass::where('status', '!=', 'cancelled')
            ->get();

        foreach ($liveClasses as $liveClass) {
            try {
                // Get time as string (HH:MM format)
                // Time is stored as TIME type in database, so it should be a string like "21:20:00"
                $timeString = $liveClass->getRawOriginal('time') ?? $liveClass->time;
                
                // If it's still a datetime object, format it
                if ($timeString instanceof \DateTime || $timeString instanceof \Carbon\Carbon) {
                    $timeString = $timeString->format('H:i:s');
                }
                
                // Ensure we have just the time part (HH:MM:SS or HH:MM)
                if (strlen($timeString) > 8) {
                    $timeString = substr($timeString, 0, 8);
                }
                
                // Combine date and time to get the scheduled datetime
                $scheduledDateTime = Carbon::parse($liveClass->date->format('Y-m-d') . ' ' . $timeString);
                $endDateTime = $scheduledDateTime->copy()->addMinutes($liveClass->duration_minutes);
            } catch (\Exception $e) {
                // Skip this live class if there's a parsing error
                $this->warn("Error parsing live class {$liveClass->id}: " . $e->getMessage());
                continue;
            }

            // Update status based on current time
            if ($now->lt($scheduledDateTime)) {
                // Before scheduled time - should be scheduled
                if ($liveClass->status !== 'scheduled') {
                    $liveClass->status = 'scheduled';
                    $liveClass->save();
                }
            } elseif ($now->gte($scheduledDateTime) && $now->lt($endDateTime)) {
                // Between scheduled time and end time - should be ongoing
                if ($liveClass->status !== 'ongoing') {
                    $liveClass->status = 'ongoing';
                    $liveClass->save();
                }
            } elseif ($now->gte($endDateTime)) {
                // After end time - should be completed
                if ($liveClass->status !== 'completed') {
                    $liveClass->status = 'completed';
                    $liveClass->save();
                }
            }
        }

        $this->info('Live class statuses updated successfully.');
        return 0;
    }
}
