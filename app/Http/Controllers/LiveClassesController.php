<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveClass;
use Illuminate\Validation\Rule;

class LiveClassesController extends Controller
{
    /**
     * Get all live classes
     */
    public function index()
    {
        $liveClasses = LiveClass::with('course')
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'live_classes' => $liveClasses
        ]);
    }

    /**
     * Get a single live class
     */
    public function show($id)
    {
        $liveClass = LiveClass::with('course')->find($id);

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
            'meeting_link' => 'required|url|max:500',
            'course_id' => 'nullable|exists:courses,id',
            'status' => 'nullable|in:scheduled,ongoing,completed,cancelled',
            'description' => 'nullable|string',
        ]);

        $liveClass = LiveClass::create([
            'class_name' => $request->class_name,
            'date' => $request->date,
            'time' => $request->time,
            'meeting_link' => $request->meeting_link,
            'course_id' => $request->course_id,
            'status' => $request->status ?? 'scheduled',
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Live class created successfully',
            'live_class' => $liveClass->load('course')
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
            'meeting_link' => 'required|url|max:500',
            'course_id' => 'nullable|exists:courses,id',
            'status' => 'nullable|in:scheduled,ongoing,completed,cancelled',
            'description' => 'nullable|string',
        ]);

        $liveClass->class_name = $request->class_name;
        $liveClass->date = $request->date;
        $liveClass->time = $request->time;
        $liveClass->meeting_link = $request->meeting_link;
        $liveClass->course_id = $request->course_id;
        $liveClass->status = $request->status ?? $liveClass->status;
        $liveClass->description = $request->description;
        $liveClass->save();

        return response()->json([
            'success' => true,
            'message' => 'Live class updated successfully',
            'live_class' => $liveClass->load('course')
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
            'live_class' => $liveClass->load('course')
        ]);
    }
}
