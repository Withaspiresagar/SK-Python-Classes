<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandSettingsController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\UISettingsController;
use App\Http\Controllers\StudentsController;

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
});

Route::get('/admin-panel', function () {
    return view('admin-panel');
})->middleware(['auth', 'admin'])->name('admin.panel');

Route::get('/admin-panel/{any}', function () {
    return view('admin-panel');
})->where('any', '.*')->middleware(['auth', 'admin']);
