<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use App\Models\Course;
use App\Models\BrandSetting;
use App\Mail\PaymentReceiptMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class PaymentsController extends Controller
{
    /**
     * Get all payments (Admin only)
     */
    public function index(Request $request)
    {
        $query = Payment::with(['user', 'course'])->orderBy('created_at', 'desc');

        // Search filter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('transaction_id', 'like', "%{$search}%")
                  ->orWhere('amount', 'like', "%{$search}%")
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

        // Payment method filter
        if ($request->has('payment_method') && $request->payment_method) {
            $query->where('payment_method', $request->payment_method);
        }

        // Date range filter
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('payment_date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('payment_date', '<=', $request->date_to);
        }

        $payments = $query->get();

        return response()->json([
            'success' => true,
            'payments' => $payments
        ]);
    }

    /**
     * Get a single payment
     */
    public function show($id)
    {
        $payment = Payment::with(['user', 'course'])->find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'payment' => $payment
        ]);
    }

    /**
     * Create a new payment (Admin only)
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'nullable|exists:courses,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,paid,failed,refunded',
            'payment_method' => 'nullable|string|max:255',
            'transaction_id' => 'nullable|string|max:255',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $payment = Payment::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'amount' => $request->amount,
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
            'payment_date' => $request->payment_date,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment created successfully',
            'payment' => $payment->load(['user', 'course'])
        ], 201);
    }

    /**
     * Update a payment (Admin only)
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'nullable|exists:courses,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,paid,failed,refunded',
            'payment_method' => 'nullable|string|max:255',
            'transaction_id' => 'nullable|string|max:255',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $payment->user_id = $request->user_id;
        $payment->course_id = $request->course_id;
        $payment->amount = $request->amount;
        $payment->status = $request->status;
        $payment->payment_method = $request->payment_method;
        $payment->transaction_id = $request->transaction_id;
        $payment->payment_date = $request->payment_date;
        $payment->notes = $request->notes;
        $payment->save();

        return response()->json([
            'success' => true,
            'message' => 'Payment updated successfully',
            'payment' => $payment->load(['user', 'course'])
        ]);
    }

    /**
     * Update payment status (Admin only)
     */
    public function updateStatus(Request $request, $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        $request->validate([
            'status' => 'required|in:pending,paid,failed,refunded',
        ]);

        $oldStatus = $payment->status;
        $payment->status = $request->status;
        $payment->save();

        // Send receipt email when status changes to paid
        if ($request->status === 'paid' && $oldStatus !== 'paid' && $payment->user && $payment->user->email) {
            try {
                Mail::to($payment->user->email)->send(new PaymentReceiptMail($payment));
            } catch (\Exception $e) {
                // Log error but don't fail the request
                \Log::error('Failed to send receipt email: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Payment status updated successfully',
            'payment' => $payment->load(['user', 'course'])
        ]);
    }

    /**
     * Delete a payment (Admin only)
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        $payment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Payment deleted successfully'
        ]);
    }

    /**
     * Get payment statistics
     */
    public function stats()
    {
        $totalPayments = Payment::count();
        $totalAmount = Payment::where('status', 'paid')->sum('amount');
        $pendingPayments = Payment::where('status', 'pending')->count();
        $paidPayments = Payment::where('status', 'paid')->count();
        $failedPayments = Payment::where('status', 'failed')->count();
        $refundedPayments = Payment::where('status', 'refunded')->count();

        return response()->json([
            'success' => true,
            'stats' => [
                'totalPayments' => $totalPayments,
                'totalAmount' => $totalAmount,
                'pendingPayments' => $pendingPayments,
                'paidPayments' => $paidPayments,
                'failedPayments' => $failedPayments,
                'refundedPayments' => $refundedPayments,
            ]
        ]);
    }

    /**
     * Generate receipt (Admin only)
     */
    public function generateReceipt($id)
    {
        $payment = Payment::with(['user', 'course'])->find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        $brandSettings = BrandSetting::first();

        $html = View::make('emails.payment-receipt', [
            'payment' => $payment,
            'brandSettings' => $brandSettings
        ])->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'payment' => $payment
        ]);
    }

    /**
     * Send receipt email (Admin only)
     */
    public function sendReceipt($id)
    {
        $payment = Payment::with(['user', 'course'])->find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        if (!$payment->user || !$payment->user->email) {
            return response()->json([
                'success' => false,
                'message' => 'Student email not found'
            ], 400);
        }

        try {
            Mail::to($payment->user->email)->send(new PaymentReceiptMail($payment));

            return response()->json([
                'success' => true,
                'message' => 'Receipt sent successfully to ' . $payment->user->email
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send receipt: ' . $e->getMessage()
            ], 500);
        }
    }
}
