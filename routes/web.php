<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandSettingsController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\UISettingsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\LiveClassesController;

Route::get('/', function () {
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
    
    // Courses Management Routes
    Route::get('/api/courses', [CoursesController::class, 'index']);
    Route::get('/api/courses/{id}', [CoursesController::class, 'show']);
    Route::post('/api/courses', [CoursesController::class, 'store']);
    Route::put('/api/courses/{id}', [CoursesController::class, 'update']);
    Route::put('/api/courses/{id}/toggle-status', [CoursesController::class, 'toggleStatus']);
    Route::delete('/api/courses/{id}', [CoursesController::class, 'destroy']);
    
    // Live Classes Management Routes
    Route::get('/api/live-classes', [LiveClassesController::class, 'index']);
    Route::get('/api/live-classes/{id}', [LiveClassesController::class, 'show']);
    Route::post('/api/live-classes', [LiveClassesController::class, 'store']);
    Route::put('/api/live-classes/{id}', [LiveClassesController::class, 'update']);
    Route::put('/api/live-classes/{id}/status', [LiveClassesController::class, 'updateStatus']);
    Route::delete('/api/live-classes/{id}', [LiveClassesController::class, 'destroy']);
});

Route::get('/admin-panel', function () {
    return view('admin-panel');
})->middleware(['auth', 'admin'])->name('admin.panel');

Route::get('/admin-panel/{any}', function () {
    return view('admin-panel');
})->where('any', '.*')->middleware(['auth', 'admin']);
