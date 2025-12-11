<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandSettingsController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\UISettingsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\LiveClassesController;
use App\Http\Controllers\QueriesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\CertificatesController;
use App\Http\Controllers\BatchController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inquiry', function () {
    return view('welcome');
});

Route::get('/courses', function () {
    return view('welcome');
});

Route::get('/about-us', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/forgot-password', function () {
    return view('forgot-password');
});

Route::post('/api/login', [AuthController::class, 'login']);
Route::post('/api/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/api/user', [AuthController::class, 'user'])->middleware('auth');

// Password Reset Routes
Route::post('/api/forgot-password/send-otp', [AuthController::class, 'sendOTP']);
Route::post('/api/forgot-password/verify-otp', [AuthController::class, 'verifyOTP']);
Route::post('/api/forgot-password/reset', [AuthController::class, 'resetPassword']);

Route::get('/api/brand-settings', [BrandSettingsController::class, 'index']);
Route::post('/api/brand-settings', [BrandSettingsController::class, 'update'])->middleware('auth');

Route::get('/api/ui-settings', [UISettingsController::class, 'index'])->middleware('auth');
Route::post('/api/ui-settings', [UISettingsController::class, 'update'])->middleware('auth');

// Queries Routes (Public - no auth required for store)
Route::post('/api/queries', [QueriesController::class, 'store']);

// Courses Routes (Public - no auth required for viewing)
Route::get('/api/courses', [CoursesController::class, 'index']);
Route::get('/api/courses/{id}', [CoursesController::class, 'show']);

// Admin Management Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/api/admins', [AdminManagementController::class, 'index']);
    Route::get('/api/admins/{id}', [AdminManagementController::class, 'show']);
    Route::post('/api/admins', [AdminManagementController::class, 'store']);
    Route::put('/api/admins/{id}', [AdminManagementController::class, 'update']);
    Route::put('/api/admins/{id}/password', [AdminManagementController::class, 'updatePassword']);
    Route::delete('/api/admins/{id}', [AdminManagementController::class, 'destroy']);
    
    // Students Management Routes
    Route::get('/api/students', [StudentsController::class, 'index']);
    Route::get('/api/students/{id}', [StudentsController::class, 'show']);
    Route::post('/api/students', [StudentsController::class, 'store']);
    Route::put('/api/students/{id}', [StudentsController::class, 'update']);
    Route::put('/api/students/{id}/toggle-status', [StudentsController::class, 'toggleStatus']);
    Route::delete('/api/students/{id}', [StudentsController::class, 'destroy']);
    
    // Courses Management Routes (Admin only for create/update/delete)
    Route::post('/api/courses', [CoursesController::class, 'store']);
    Route::put('/api/courses/{id}', [CoursesController::class, 'update']);
    Route::put('/api/courses/{id}/toggle-status', [CoursesController::class, 'toggleStatus']);
    Route::delete('/api/courses/{id}', [CoursesController::class, 'destroy']);
    
    // Live Classes Management Routes
    Route::get('/api/live-classes', [LiveClassesController::class, 'index']);
    Route::get('/api/live-classes/active-batches', [LiveClassesController::class, 'getActiveBatches']);
    Route::get('/api/live-classes/{id}', [LiveClassesController::class, 'show']);
    Route::post('/api/live-classes', [LiveClassesController::class, 'store']);
    Route::put('/api/live-classes/{id}', [LiveClassesController::class, 'update']);
    Route::put('/api/live-classes/{id}/status', [LiveClassesController::class, 'updateStatus']);
    Route::delete('/api/live-classes/{id}', [LiveClassesController::class, 'destroy']);
    
    // Queries Management Routes (Admin only)
    Route::get('/api/queries', [QueriesController::class, 'index']);
    Route::get('/api/queries/{id}', [QueriesController::class, 'show']);
    Route::put('/api/queries/{id}/status', [QueriesController::class, 'updateStatus']);
    Route::delete('/api/queries/{id}', [QueriesController::class, 'destroy']);
    
    // Reports Routes (Admin only)
    Route::get('/api/reports', [ReportsController::class, 'index']);
    Route::get('/api/dashboard', [ReportsController::class, 'dashboard']);
    
    // Payments Routes (Admin only)
    Route::get('/api/payments', [PaymentsController::class, 'index']);
    Route::get('/api/payments/stats', [PaymentsController::class, 'stats']);
    Route::get('/api/payments/{id}', [PaymentsController::class, 'show']);
    Route::get('/api/payments/{id}/receipt', [PaymentsController::class, 'generateReceipt']);
    Route::post('/api/payments/{id}/send-receipt', [PaymentsController::class, 'sendReceipt']);
    Route::post('/api/payments', [PaymentsController::class, 'store']);
    Route::put('/api/payments/{id}', [PaymentsController::class, 'update']);
    Route::put('/api/payments/{id}/status', [PaymentsController::class, 'updateStatus']);
    Route::delete('/api/payments/{id}', [PaymentsController::class, 'destroy']);
    
    // Certificates Routes (Admin only)
    Route::get('/api/certificates', [CertificatesController::class, 'index']);
    Route::get('/api/certificates/stats', [CertificatesController::class, 'stats']);
    Route::get('/api/certificates/{id}', [CertificatesController::class, 'show']);
    Route::get('/api/certificates/{id}/download', [CertificatesController::class, 'download']);
    Route::post('/api/certificates', [CertificatesController::class, 'store']);
    Route::post('/api/certificates/bulk-generate', [CertificatesController::class, 'bulkGenerate']);
    Route::put('/api/certificates/{id}', [CertificatesController::class, 'update']);
    Route::delete('/api/certificates/{id}', [CertificatesController::class, 'destroy']);
    
    // Batches Management Routes (Admin only)
    Route::get('/api/batches', [BatchController::class, 'index']);
    Route::get('/api/batches/active-courses', [BatchController::class, 'getActiveCourses']);
    Route::get('/api/batches/{id}', [BatchController::class, 'show']);
    Route::post('/api/batches', [BatchController::class, 'store']);
    Route::put('/api/batches/{id}', [BatchController::class, 'update']);
    Route::put('/api/batches/{id}/toggle-status', [BatchController::class, 'toggleStatus']);
    Route::post('/api/batches/{id}/assign-students', [BatchController::class, 'assignStudents']);
    Route::delete('/api/batches/{id}', [BatchController::class, 'destroy']);
});

// Certificate Verification (Public)
Route::get('/api/certificates/verify/{certificateNumber}', [CertificatesController::class, 'verify']);
Route::get('/certificateverify', function () {
    return view('welcome');
})->name('certificate.verify.page');
Route::get('/certificateverify/{certificateNumber}', function () {
    return view('welcome');
})->name('certificate.verify.number');

Route::get('/admin-panel', function () {
    return view('admin-panel');
})->middleware(['auth', 'admin'])->name('admin.panel');

Route::get('/admin-panel/{any}', function () {
    return view('admin-panel');
})->where('any', '.*')->middleware(['auth', 'admin']);

// Student Dashboard Routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('student.dashboard');

Route::get('/dashboard/{any}', function () {
    return view('dashboard');
})->where('any', '.*')->middleware('auth');

// Student API Routes
Route::middleware('auth')->group(function () {
    Route::get('/api/student/dashboard', [StudentsController::class, 'dashboard']);
    Route::get('/api/student/live-classes', [StudentsController::class, 'liveClasses']);
    Route::get('/api/student/payments', [StudentsController::class, 'payments']);
    Route::get('/api/student/certificates', [StudentsController::class, 'certificates']);
    Route::get('/api/student/certificates/{id}/download', [StudentsController::class, 'downloadCertificate']);
    Route::get('/api/student/payments/{id}/receipt', [StudentsController::class, 'viewReceipt']);
});
