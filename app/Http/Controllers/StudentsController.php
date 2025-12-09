<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StudentsController extends Controller
{
    /**
     * Get all students
     */
    public function index()
    {
        $students = User::where('role', 'student')
            ->select('id', 'name', 'email', 'phone', 'date_of_birth', 'role', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'students' => $students
        ]);
    }

    /**
     * Get a single student
     */
    public function show($id)
    {
        $student = User::where('role', 'student')
            ->where('id', $id)
            ->select('id', 'name', 'email', 'phone', 'date_of_birth', 'role', 'status', 'created_at', 'updated_at')
            ->first();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'student' => $student
        ]);
    }

    /**
     * Create a new student
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'password_type' => 'required|in:local,email',
        ];

        // Only require password validation if password_type is local
        if ($request->password_type === 'local') {
            $rules['password'] = 'required|string|min:6';
        }

        $request->validate($rules);

        $password = null;
        $generatedPassword = null;

        if ($request->password_type === 'local') {
            $password = Hash::make($request->password);
        } else {
            // Generate random password
            $generatedPassword = Str::random(12);
            $password = Hash::make($generatedPassword);
        }

        $student = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'password' => $password,
            'role' => 'student',
            'status' => 'active',
        ]);

        // Send email with password if email type was selected
        if ($request->password_type === 'email' && $generatedPassword) {
            try {
                Mail::send('emails.student-credentials', [
                    'name' => $student->name,
                    'email' => $student->email,
                    'password' => $generatedPassword,
                ], function ($message) use ($student) {
                    $message->to($student->email, $student->name)
                        ->subject('Your Account Credentials - SK Python Classes');
                });
            } catch (\Exception $e) {
                // Log error but don't fail the request
                \Log::error('Failed to send student credentials email: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => $request->password_type === 'email' 
                ? 'Student created successfully. Password has been sent to their email.' 
                : 'Student created successfully',
            'student' => [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'phone' => $student->phone,
                'date_of_birth' => $student->date_of_birth,
                'role' => $student->role,
                'status' => $student->status,
                'created_at' => $student->created_at,
            ]
        ], 201);
    }

    /**
     * Update a student
     */
    public function update(Request $request, $id)
    {
        $student = User::where('role', 'student')->find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($student->id)
            ],
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
        ]);

        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->date_of_birth = $request->date_of_birth;
        $student->save();

        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully',
            'student' => [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'phone' => $student->phone,
                'date_of_birth' => $student->date_of_birth,
                'role' => $student->role,
                'status' => $student->status,
                'created_at' => $student->created_at,
            ]
        ]);
    }

    /**
     * Toggle student status (active/inactive)
     */
    public function toggleStatus($id)
    {
        $student = User::where('role', 'student')->find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        $student->status = $student->status === 'active' ? 'inactive' : 'active';
        $student->save();

        return response()->json([
            'success' => true,
            'message' => 'Student status updated successfully',
            'student' => [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'status' => $student->status,
            ]
        ]);
    }

    /**
     * Delete a student
     */
    public function destroy($id)
    {
        $student = User::where('role', 'student')->find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Student deleted successfully'
        ]);
    }
}
