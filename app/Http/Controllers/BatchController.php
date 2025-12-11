<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Course;
use App\Models\User;

class BatchController extends Controller
{
    /**
     * Get all batches
     */
    public function index()
    {
        $batches = Batch::with(['course', 'students'])->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'batches' => $batches
        ]);
    }

    /**
     * Get a single batch
     */
    public function show($id)
    {
        $batch = Batch::with(['course', 'students'])->find($id);

        if (!$batch) {
            return response()->json([
                'success' => false,
                'message' => 'Batch not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'batch' => $batch
        ]);
    }

    /**
     * Create a new batch
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'nullable|exists:courses,id',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable|in:active,inactive',
        ]);

        $batch = Batch::create([
            'name' => $request->name,
            'course_id' => $request->course_id,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status ?? 'active',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Batch created successfully',
            'batch' => $batch
        ], 201);
    }

    /**
     * Update a batch
     */
    public function update(Request $request, $id)
    {
        $batch = Batch::find($id);

        if (!$batch) {
            return response()->json([
                'success' => false,
                'message' => 'Batch not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'nullable|exists:courses,id',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable|in:active,inactive',
        ]);

        $batch->update([
            'name' => $request->name,
            'course_id' => $request->course_id,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status ?? $batch->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Batch updated successfully',
            'batch' => $batch
        ]);
    }

    /**
     * Delete a batch
     */
    public function destroy($id)
    {
        $batch = Batch::find($id);

        if (!$batch) {
            return response()->json([
                'success' => false,
                'message' => 'Batch not found'
            ], 404);
        }

        $batch->delete();

        return response()->json([
            'success' => true,
            'message' => 'Batch deleted successfully'
        ]);
    }

    /**
     * Toggle batch status
     */
    public function toggleStatus($id)
    {
        $batch = Batch::find($id);

        if (!$batch) {
            return response()->json([
                'success' => false,
                'message' => 'Batch not found'
            ], 404);
        }

        $batch->status = $batch->status === 'active' ? 'inactive' : 'active';
        $batch->save();

        return response()->json([
            'success' => true,
            'message' => 'Batch status updated successfully',
            'batch' => $batch
        ]);
    }

    /**
     * Assign students to batch
     */
    public function assignStudents(Request $request, $id)
    {
        $batch = Batch::find($id);

        if (!$batch) {
            return response()->json([
                'success' => false,
                'message' => 'Batch not found'
            ], 404);
        }

        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:users,id'
        ]);

        // Verify all IDs are students
        $studentIds = User::whereIn('id', $request->student_ids)
            ->where('role', 'student')
            ->pluck('id')
            ->toArray();

        $batch->users()->sync($studentIds);

        return response()->json([
            'success' => true,
            'message' => 'Students assigned to batch successfully',
            'batch' => $batch->load('students')
        ]);
    }

    /**
     * Get active courses for batch assignment
     */
    public function getActiveCourses()
    {
        $courses = Course::where('status', 'active')
            ->orderBy('name', 'asc')
            ->get(['id', 'name']);

        return response()->json([
            'success' => true,
            'courses' => $courses
        ]);
    }
}
