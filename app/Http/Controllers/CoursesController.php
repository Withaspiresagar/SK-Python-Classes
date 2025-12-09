<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CoursesController extends Controller
{
    /**
     * Get all courses
     */
    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'courses' => $courses
        ]);
    }

    /**
     * Get a single course
     */
    public function show($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'course' => $course
        ]);
    }

    /**
     * Create a new course
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price' => 'nullable|numeric|min:0',
            'status' => 'nullable|in:active,inactive',
            'duration_hours' => 'nullable|integer|min:0',
            'level' => 'nullable|in:beginner,intermediate,advanced',
            'what_you_will_learn' => 'nullable|string',
            'requirements' => 'nullable|string',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        $course = Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'price' => $request->price ?? 0,
            'status' => $request->status ?? 'active',
            'duration_hours' => $request->duration_hours,
            'level' => $request->level,
            'what_you_will_learn' => $request->what_you_will_learn,
            'requirements' => $request->requirements,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Course created successfully',
            'course' => $course
        ], 201);
    }

    /**
     * Update a course
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price' => 'nullable|numeric|min:0',
            'status' => 'nullable|in:active,inactive',
            'duration_hours' => 'nullable|integer|min:0',
            'level' => 'nullable|in:beginner,intermediate,advanced',
            'what_you_will_learn' => 'nullable|string',
            'requirements' => 'nullable|string',
        ]);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('courses/thumbnails', 'public');
            $course->thumbnail = $thumbnailPath;
        }

        $course->name = $request->name;
        $course->description = $request->description;
        $course->price = $request->price ?? $course->price;
        $course->status = $request->status ?? $course->status;
        $course->duration_hours = $request->duration_hours;
        $course->level = $request->level;
        $course->what_you_will_learn = $request->what_you_will_learn;
        $course->requirements = $request->requirements;
        $course->save();

        return response()->json([
            'success' => true,
            'message' => 'Course updated successfully',
            'course' => $course
        ]);
    }

    /**
     * Delete a course
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        // Delete thumbnail if exists
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course deleted successfully'
        ]);
    }

    /**
     * Toggle course status
     */
    public function toggleStatus($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        $course->status = $course->status === 'active' ? 'inactive' : 'active';
        $course->save();

        return response()->json([
            'success' => true,
            'message' => 'Course status updated successfully',
            'course' => $course
        ]);
    }
}
