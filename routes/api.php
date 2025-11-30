<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ===================== AUTH =====================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// -------- Protected (Login Required) --------
Route::middleware('auth:sanctum')->group(function () {

    // Profile user login
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);


    // ===================== ADMIN PROTECTED =====================
    Route::middleware('is_admin')->group(function () {

        // Dashboard admin
        Route::get('/admin/dashboard', function () {
            return ['message' => 'Welcome, admin!'];
        });

        // ===== BERITA ADMIN =====
        Route::post('/berita', [BeritaController::class, 'store']); // tambah
        Route::put('/berita/{id}', [BeritaController::class, 'update']); // update
        Route::put('/berita/{id}/archive', [BeritaController::class, 'changeStatus']); // arsipkan
        Route::put('/berita/{id}/publish', [BeritaController::class, 'changeStatus1']); // publish ulang

        // ===== KOMUNITAS ADMIN =====
        Route::post('/komunitas', [KomunitasController::class, 'store']);
        Route::patch('/komunitas/{id}/status', [KomunitasController::class, 'changeStatus']);
        Route::put('/komunitas/{id}', [KomunitasController::class, 'update']);

        // ===== EVENTS ADMIN =====
        Route::post('/events', [EventController::class, 'store']);
        Route::put('/events/{id}', [EventController::class, 'update']);
        Route::patch('/events/{id}/status', [EventController::class, 'changeStatus']);

        // ===== USERS ADMIN =====
        Route::get('/users', [AdminUserController::class, 'index']);
        Route::patch('/users/{id}/status', [AdminUserController::class, 'changeStatus']);

        // Statistik admin
        Route::get('/admin/stats', [AdminController::class, 'getStats']);
    });

});

// ===================== PUBLIC ROUTES =====================

// BERITA (bebas akses)
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/homepage-berita', [BeritaController::class, 'homepage']);

// KOMUNITAS (bebas lihat)
Route::get('/komunitas', [KomunitasController::class, 'index']);

// EVENTS (bebas lihat)
Route::get('/events', [EventController::class, 'index']);

