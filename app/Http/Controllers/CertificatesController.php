<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\User;
use App\Models\Course;
use App\Models\Batch;
use App\Models\BrandSetting;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CertificatesController extends Controller
{
    /**
     * Get all certificates (Admin only)
     */
    public function index(Request $request)
    {
        $query = Certificate::with(['user', 'course'])->orderBy('created_at', 'desc');

        // Search filter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('certificate_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhereHas('course', function($courseQuery) use ($search) {
                      $courseQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Status filter
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $certificates = $query->get();

        return response()->json([
            'success' => true,
            'certificates' => $certificates
        ]);
    }

    /**
     * Get a single certificate
     */
    public function show($id)
    {
        $certificate = Certificate::with(['user', 'course'])->find($id);

        if (!$certificate) {
            return response()->json([
                'success' => false,
                'message' => 'Certificate not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'certificate' => $certificate
        ]);
    }

    /**
     * Verify certificate by certificate number (Public)
     */
    public function verify($certificateNumber)
    {
        $certificate = Certificate::with(['user', 'course'])
            ->where('certificate_number', $certificateNumber)
            ->where('status', 'active')
            ->first();

        if (!$certificate) {
            return response()->json([
                'success' => false,
                'message' => 'Certificate not found or has been revoked'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'certificate' => $certificate,
            'valid' => true
        ]);
    }

    /**
     * Create a new certificate (Admin only)
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'issue_date' => 'required|date',
            'expiry_date' => 'nullable|date|after:issue_date',
            'notes' => 'nullable|string',
        ]);

        // Check if certificate already exists for this user and course
        $existing = Certificate::where('user_id', $request->user_id)
            ->where('course_id', $request->course_id)
            ->where('status', 'active')
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Certificate already exists for this student and course'
            ], 400);
        }

        $certificate = Certificate::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'certificate_number' => Certificate::generateCertificateNumber(),
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            'status' => 'active',
            'notes' => $request->notes,
        ]);

        // Generate PDF
        $this->generateCertificatePDF($certificate);

        return response()->json([
            'success' => true,
            'message' => 'Certificate created successfully',
            'certificate' => $certificate->load(['user', 'course'])
        ], 201);
    }

    /**
     * Update a certificate (Admin only)
     */
    public function update(Request $request, $id)
    {
        $certificate = Certificate::find($id);

        if (!$certificate) {
            return response()->json([
                'success' => false,
                'message' => 'Certificate not found'
            ], 404);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'issue_date' => 'required|date',
            'expiry_date' => 'nullable|date|after:issue_date',
            'status' => 'required|in:active,revoked',
            'notes' => 'nullable|string',
        ]);

        $certificate->user_id = $request->user_id;
        $certificate->course_id = $request->course_id;
        $certificate->issue_date = $request->issue_date;
        $certificate->expiry_date = $request->expiry_date;
        $certificate->status = $request->status;
        $certificate->notes = $request->notes;
        $certificate->save();

        // Regenerate PDF if needed
        if ($certificate->status === 'active') {
            $this->generateCertificatePDF($certificate);
        }

        return response()->json([
            'success' => true,
            'message' => 'Certificate updated successfully',
            'certificate' => $certificate->load(['user', 'course'])
        ]);
    }

    /**
     * Delete a certificate (Admin only)
     */
    public function destroy($id)
    {
        $certificate = Certificate::find($id);

        if (!$certificate) {
            return response()->json([
                'success' => false,
                'message' => 'Certificate not found'
            ], 404);
        }

        // Delete PDF file if exists
        if ($certificate->certificate_pdf && Storage::disk('public')->exists($certificate->certificate_pdf)) {
            Storage::disk('public')->delete($certificate->certificate_pdf);
        }

        $certificate->delete();

        return response()->json([
            'success' => true,
            'message' => 'Certificate deleted successfully'
        ]);
    }

    /**
     * Download certificate PDF
     */
    public function download($id)
    {
        $certificate = Certificate::with(['user', 'course'])->find($id);

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
        $brandSettings = BrandSetting::first();

        $data = [
            'certificate' => $certificate,
            'brandSettings' => $brandSettings,
        ];

        $pdf = PDF::loadView('certificates.certificate-pdf', $data);
        
        // Save PDF
        $filename = 'certificates/' . $certificate->certificate_number . '.pdf';
        Storage::disk('public')->put($filename, $pdf->output());

        $certificate->certificate_pdf = $filename;
        $certificate->save();
    }

    /**
     * Get certificate statistics
     */
    public function stats()
    {
        $totalCertificates = Certificate::count();
        $activeCertificates = Certificate::where('status', 'active')->count();
        $revokedCertificates = Certificate::where('status', 'revoked')->count();
        $thisMonthCertificates = Certificate::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return response()->json([
            'success' => true,
            'stats' => [
                'totalCertificates' => $totalCertificates,
                'activeCertificates' => $activeCertificates,
                'revokedCertificates' => $revokedCertificates,
                'thisMonthCertificates' => $thisMonthCertificates,
            ]
        ]);
    }

    /**
     * Bulk generate certificates for all students in a batch
     */
    public function bulkGenerate(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'issue_date' => 'required|date',
            'expiry_date' => 'nullable|date|after:issue_date',
            'notes' => 'nullable|string',
        ]);

        $batch = Batch::with(['course'])->find($request->batch_id);

        if (!$batch) {
            return response()->json([
                'success' => false,
                'message' => 'Batch not found'
            ], 404);
        }

        if (!$batch->course_id) {
            return response()->json([
                'success' => false,
                'message' => 'Batch does not have an associated course'
            ], 400);
        }

        // Get students from batch (only students, not admins)
        $students = $batch->users()->where('role', 'student')->get();

        if ($students->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No students found in this batch'
            ], 400);
        }

        $generated = 0;
        $skipped = 0;
        $errors = [];

        foreach ($students as $student) {
            // Check if certificate already exists
            $existing = Certificate::where('user_id', $student->id)
                ->where('course_id', $batch->course_id)
                ->where('status', 'active')
                ->first();

            if ($existing) {
                $skipped++;
                continue;
            }

            try {
                $certificate = Certificate::create([
                    'user_id' => $student->id,
                    'course_id' => $batch->course_id,
                    'certificate_number' => Certificate::generateCertificateNumber(),
                    'issue_date' => $request->issue_date,
                    'expiry_date' => $request->expiry_date,
                    'status' => 'active',
                    'notes' => $request->notes,
                ]);

                // Generate PDF
                $this->generateCertificatePDF($certificate);
                $generated++;
            } catch (\Exception $e) {
                $errors[] = "Failed to generate certificate for {$student->name}: " . $e->getMessage();
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Certificates generated successfully. Generated: {$generated}, Skipped: {$skipped}",
            'generated' => $generated,
            'skipped' => $skipped,
            'errors' => $errors
        ], 201);
    }
}
