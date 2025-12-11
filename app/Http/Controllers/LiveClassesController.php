<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveClass;
use App\Models\Batch;
use Illuminate\Validation\Rule;

class LiveClassesController extends Controller
{
    /**
     * Get all live classes
     */
    public function index()
    {
        // Update statuses before fetching
        $this->updateLiveClassStatuses();
        
        $liveClasses = LiveClass::with(['batch', 'batch.course'])
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'live_classes' => $liveClasses
        ]);
    }

    /**
     * Update live class statuses based on current time
     */
    private function updateLiveClassStatuses()
    {
        $now = \Carbon\Carbon::now();
        
        // Update all non-cancelled live classes
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
                
                $scheduledDateTime = \Carbon\Carbon::parse($liveClass->date->format('Y-m-d') . ' ' . $timeString);
                $endDateTime = $scheduledDateTime->copy()->addMinutes($liveClass->duration_minutes ?? 60);
            } catch (\Exception $e) {
                // Skip this live class if there's a parsing error
                \Log::warning('Error parsing live class time', [
                    'live_class_id' => $liveClass->id,
                    'date' => $liveClass->date,
                    'time' => $liveClass->time,
                    'error' => $e->getMessage()
                ]);
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
    }

    /**
     * Get a single live class
     */
    public function show($id)
    {
        // Update statuses before fetching
        $this->updateLiveClassStatuses();
        
        $liveClass = LiveClass::with(['batch', 'batch.course', 'batch.students'])->find($id);

        if (!$liveClass) {
            return response()->json([
                'success' => false,
                'message' => 'Live class not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'live_class' => $liveClass
        ]);
    }

    /**
     * Create a new live class
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'duration_minutes' => 'required|integer|min:1|max:480',
            'meeting_link' => 'required|url|max:500',
            'batch_id' => 'required|exists:batches,id',
            'status' => 'nullable|in:scheduled,ongoing,completed,cancelled',
            'description' => 'nullable|string',
        ]);

        $liveClass = LiveClass::create([
            'class_name' => $request->class_name,
            'date' => $request->date,
            'time' => $request->time,
            'duration_minutes' => $request->duration_minutes,
            'meeting_link' => $request->meeting_link,
            'batch_id' => $request->batch_id,
            'status' => 'scheduled', // Always start as scheduled
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Live class created successfully',
            'live_class' => $liveClass->load(['batch', 'batch.course'])
        ], 201);
    }

    /**
     * Update a live class
     */
    public function update(Request $request, $id)
    {
        $liveClass = LiveClass::find($id);

        if (!$liveClass) {
            return response()->json([
                'success' => false,
                'message' => 'Live class not found'
            ], 404);
        }

        $request->validate([
            'class_name' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'duration_minutes' => 'required|integer|min:1|max:480',
            'meeting_link' => 'required|url|max:500',
            'batch_id' => 'required|exists:batches,id',
            'status' => 'nullable|in:scheduled,ongoing,completed,cancelled',
            'description' => 'nullable|string',
        ]);

        $liveClass->class_name = $request->class_name;
        $liveClass->date = $request->date;
        $liveClass->time = $request->time;
        $liveClass->duration_minutes = $request->duration_minutes;
        $liveClass->meeting_link = $request->meeting_link;
        $liveClass->batch_id = $request->batch_id;
        // Don't allow manual status change if class is scheduled - let auto-update handle it
        if ($request->has('status') && $request->status !== 'cancelled') {
            $liveClass->status = $request->status;
        }
        $liveClass->description = $request->description;
        $liveClass->save();

        return response()->json([
            'success' => true,
            'message' => 'Live class updated successfully',
            'live_class' => $liveClass->load(['batch', 'batch.course'])
        ]);
    }

    /**
     * Delete a live class
     */
    public function destroy($id)
    {
        $liveClass = LiveClass::find($id);

        if (!$liveClass) {
            return response()->json([
                'success' => false,
                'message' => 'Live class not found'
            ], 404);
        }

        $liveClass->delete();

        return response()->json([
            'success' => true,
            'message' => 'Live class deleted successfully'
        ]);
    }

    /**
     * Update live class status
     */
    public function updateStatus(Request $request, $id)
    {
        $liveClass = LiveClass::find($id);

        if (!$liveClass) {
            return response()->json([
                'success' => false,
                'message' => 'Live class not found'
            ], 404);
        }

        $request->validate([
            'status' => 'required|in:scheduled,ongoing,completed,cancelled',
        ]);

        $liveClass->status = $request->status;
        $liveClass->save();

        return response()->json([
            'success' => true,
            'message' => 'Live class status updated successfully',
            'live_class' => $liveClass->load(['batch', 'batch.course'])
        ]);
    }

    /**
     * Get active batches for live class assignment
     */
    public function getActiveBatches()
    {
        $batches = \App\Models\Batch::where('status', 'active')
            ->with('course')
            ->orderBy('name', 'asc')
            ->get(['id', 'name', 'course_id']);

        return response()->json([
            'success' => true,
            'batches' => $batches
        ]);
    }
}
