<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminManagementController extends Controller
{
    /**
     * Get all admin users
     */
    public function index()
    {
        $admins = User::where('role', 'admin')
            ->select('id', 'name', 'email', 'role', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'admins' => $admins
        ]);
    }

    /**
     * Get a single admin user
     */
    public function show($id)
    {
        $admin = User::where('role', 'admin')
            ->where('id', $id)
            ->select('id', 'name', 'email', 'role', 'created_at', 'updated_at')
            ->first();

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'admin' => $admin
        ]);
    }

    /**
     * Create a new admin user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Admin created successfully',
            'admin' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'role' => $admin->role,
                'created_at' => $admin->created_at,
            ]
        ], 201);
    }

    /**
     * Update an admin user
     */
    public function update(Request $request, $id)
    {
        $admin = User::where('role', 'admin')->find($id);

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($admin->id)
            ],
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return response()->json([
            'success' => true,
            'message' => 'Admin updated successfully',
            'admin' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'role' => $admin->role,
                'created_at' => $admin->created_at,
            ]
        ]);
    }

    /**
     * Update admin password
     */
    public function updatePassword(Request $request, $id)
    {
        $admin = User::where('role', 'admin')->find($id);

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not found'
            ], 404);
        }

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $admin->password = Hash::make($request->password);
        $admin->save();

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully'
        ]);
    }

    /**
     * Delete an admin user
     */
    public function destroy($id)
    {
        $admin = User::where('role', 'admin')->find($id);

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not found'
            ], 404);
        }

        // Prevent deleting yourself
        if ($admin->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot delete your own account'
            ], 403);
        }

        $admin->delete();

        return response()->json([
            'success' => true,
            'message' => 'Admin deleted successfully'
        ]);
    }
}
