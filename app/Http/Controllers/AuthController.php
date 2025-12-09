<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Check if user is active (only for students, admins can always login)
            if ($user->isStudent() && $user->status === 'inactive') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                throw ValidationException::withMessages([
                    'email' => ['Your account is inactive. Please contact administrator to activate your account.'],
                ]);
            }
            
            return response()->json([
                'success' => true,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                'redirect' => $user->isAdmin() ? '/admin-panel' : '/dashboard',
            ]);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    /**
     * Get authenticated user
     */
    public function user(Request $request)
    {
        $user = Auth::user();
        
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],
        ]);
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['success' => true]);
    }

    /**
     * Send OTP for password reset
     */
    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email not found in our records.'
            ], 404);
        }

        // Check if user is active
        if ($user->status === 'inactive') {
            return response()->json([
                'success' => false,
                'message' => 'Student is inactive. Please contact administrator to activate your account.'
            ], 403);
        }

        // Generate 6-digit OTP
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = Carbon::now()->addMinutes(10); // OTP valid for 10 minutes

        // Delete old OTPs for this email
        DB::table('password_reset_otps')
            ->where('email', $request->email)
            ->where('used', false)
            ->delete();

        // Store new OTP
        DB::table('password_reset_otps')->insert([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => $expiresAt,
            'used' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Send OTP via email
        try {
            Mail::send('emails.password-reset-otp', [
                'name' => $user->name,
                'otp' => $otp,
            ], function ($message) use ($user) {
                $message->to($user->email, $user->name)
                    ->subject('Password Reset OTP - SK Python Classes');
            });

            return response()->json([
                'success' => true,
                'message' => 'OTP has been sent to your email address.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP email: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP. Please try again later.'
            ], 500);
        }
    }

    /**
     * Verify OTP
     */
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
        ]);

        // Check if user is active
        $user = User::where('email', $request->email)->first();
        if ($user && $user->status === 'inactive') {
            return response()->json([
                'success' => false,
                'message' => 'Student is inactive. Please contact administrator to activate your account.'
            ], 403);
        }

        $otpRecord = DB::table('password_reset_otps')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP. Please request a new one.'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully.'
        ]);
    }

    /**
     * Reset password after OTP verification
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string|size:6',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Verify OTP
        $otpRecord = DB::table('password_reset_otps')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP. Please request a new one.'
            ], 400);
        }

        // Update password
        $user = User::where('email', $request->email)->first();
        
        // Check if user is active
        if ($user->status === 'inactive') {
            return response()->json([
                'success' => false,
                'message' => 'Student is inactive. Please contact administrator to activate your account.'
            ], 403);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Mark OTP as used
        DB::table('password_reset_otps')
            ->where('id', $otpRecord->id)
            ->update(['used' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Password has been reset successfully. You can now login with your new password.'
        ]);
    }
}
