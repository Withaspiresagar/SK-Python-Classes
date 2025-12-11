<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\Certificate;
use App\Models\LiveClass;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
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
            ->with('batches')
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
            ->with('batches')
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

        // Attach batches if provided
        if ($request->has('batch_ids') && is_array($request->batch_ids)) {
            $student->batches()->sync($request->batch_ids);
        }

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

    /**
     * Get student dashboard data
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get enrolled courses count (courses with payments)
        $enrolledCourses = Payment::where('user_id', $user->id)
            ->where('status', 'paid')
            ->distinct('course_id')
            ->count('course_id');

        // Get certificates count
        $certificates = Certificate::where('user_id', $user->id)
            ->where('status', 'active')
            ->count();

        // Get total payments count
        $totalPayments = Payment::where('user_id', $user->id)->count();

        // Update live class statuses before fetching
        $this->updateLiveClassStatuses();
        
        // Get student's batch IDs
        $batchIds = $user->batches()->pluck('batches.id');
        
        // Get upcoming live classes for student's batches (next 7 days)
        $upcomingClasses = LiveClass::whereIn('batch_id', $batchIds)
            ->where('date', '>=', Carbon::today())
            ->where('date', '<=', Carbon::today()->addDays(7))
            ->where('status', '!=', 'cancelled')
            ->with(['batch', 'batch.course'])
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->limit(6)
            ->get();

        // Get recent payments (last 5)
        $recentPayments = Payment::where('user_id', $user->id)
            ->with('course')
            ->orderBy('payment_date', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'stats' => [
                'enrolledCourses' => $enrolledCourses,
                'certificates' => $certificates,
                'totalPayments' => $totalPayments,
                'upcomingClasses' => $upcomingClasses->count()
            ],
            'upcomingClasses' => $upcomingClasses,
            'recentPayments' => $recentPayments
        ]);
    }

    /**
     * Get student live classes
     */
    public function liveClasses()
    {
        $user = Auth::user();
        
        // Update live class statuses before fetching
        $this->updateLiveClassStatuses();
        
        // Get student's batch IDs
        $batchIds = $user->batches()->pluck('batches.id');
        
        // Get all live classes for student's batches
        $liveClasses = LiveClass::whereIn('batch_id', $batchIds)
            ->where('date', '>=', Carbon::today())
            ->where('status', '!=', 'cancelled')
            ->with(['batch', 'batch.course'])
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'liveClasses' => $liveClasses
        ]);
    }

    /**
     * Update live class statuses based on current time
     */
    private function updateLiveClassStatuses()
    {
        $now = Carbon::now();
        
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
                
                $scheduledDateTime = Carbon::parse($liveClass->date->format('Y-m-d') . ' ' . $timeString);
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
     * Get student payments
     */
    public function payments()
    {
        $user = Auth::user();
        
        $payments = Payment::where('user_id', $user->id)
            ->with('course')
            ->orderBy('payment_date', 'desc')
            ->get();

        $totalPaid = Payment::where('user_id', $user->id)
            ->where('status', 'paid')
            ->sum('amount');

        $pendingAmount = Payment::where('user_id', $user->id)
            ->where('status', 'pending')
            ->sum('amount');

        return response()->json([
            'success' => true,
            'payments' => $payments,
            'stats' => [
                'totalPaid' => $totalPaid,
                'pendingAmount' => $pendingAmount,
                'totalPayments' => $payments->count()
            ]
        ]);
    }

    /**
     * Get student certificates
     */
    public function certificates()
    {
        $user = Auth::user();
        
        $certificates = Certificate::where('user_id', $user->id)
            ->with('course')
            ->orderBy('issue_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'certificates' => $certificates
        ]);
    }

    /**
     * Download student certificate
     */
    public function downloadCertificate($id)
    {
        $user = Auth::user();
        
        $certificate = Certificate::with(['user', 'course'])
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$certificate) {
            return response()->json([
                'success' => false,
                'message' => 'Certificate not found'
            ], 404);
        }

        if (!$certificate->certificate_pdf || !Storage::disk('public')->exists($certificate->certificate_pdf)) {
            // Generate PDF if doesn't exist
            $this->generateCertificatePDF($certificate);
            $certificate->refresh();
        }

        return Storage::disk('public')->download($certificate->certificate_pdf, $certificate->certificate_number . '.pdf');
    }

    /**
     * Generate certificate PDF
     */
    private function generateCertificatePDF($certificate)
    {
        $certificate->load(['user', 'course']);
        $brandSettings = \App\Models\BrandSetting::first();

        $data = [
            'certificate' => $certificate,
            'brandSettings' => $brandSettings,
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('certificates.certificate-pdf', $data);
        
        // Save PDF
        $filename = 'certificates/' . $certificate->certificate_number . '.pdf';
        Storage::disk('public')->put($filename, $pdf->output());

        $certificate->certificate_pdf = $filename;
        $certificate->save();
    }

    /**
     * View payment receipt (Student only - their own payments)
     */
    public function viewReceipt($id)
    {
        $user = Auth::user();
        
        $payment = Payment::with(['user', 'course'])
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        $brandSettings = \App\Models\BrandSetting::first();

        $html = \Illuminate\Support\Facades\View::make('emails.payment-receipt', [
            'payment' => $payment,
            'brandSettings' => $brandSettings
        ])->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'payment' => $payment
        ]);
    }
}
