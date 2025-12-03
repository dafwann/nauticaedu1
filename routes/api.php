<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Semua route API masuk di sini
|--------------------------------------------------------------------------
*/

// --- AUTH ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// --- RESET PASSWORD ---
Route::post('/reset-password', [AuthController::class, 'resetPassword']);


// --- ROUTE DILINDUNGI LOGIN ---
Route::middleware('auth:sanctum')->group(function() {

    // data user yang sedang login
    Route::get('/profile', function(Request $request) {
        return $request->user();
    });

    // logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // 🔥 WAJIB LOGIN untuk akses course & komunitas
    Route::get('/komunitas', [KomunitasController::class, 'index']);
    Route::post('/komunitas', [KomunitasController::class, 'store']);

    Route::get('/courses', [CourseController::class, 'index']);
    Route::post('/courses', [CourseController::class, 'store']);
});



// --- (OPSI) ROUTE ADMIN ---
Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {

    Route::get('/admin/dashboard', function() {
        return ['message' => 'Welcome, admin!'];
    });

});

Route::middleware(['auth:api', 'is.admin'])->get('/admin/data', function () {
    return "Hai admin!";
});



// ADMIN
Route::get('/berita', [BeritaController::class, 'index']);
Route::post('/berita', [BeritaController::class, 'store']);
Route::put('/berita/{id}', [BeritaController::class, 'update']);
Route::put('/berita/{id}/archive', [BeritaController::class, 'archive']);
Route::put('/berita/{id}/published', [BeritaController::class, 'publish']);
// USER
Route::get('/homepage-berita', [BeritaController::class, 'homepage']);



use App\Http\Controllers\KomunitasController;

Route::get('/komunitas', [KomunitasController::class, 'index']);
Route::post('/komunitas', [KomunitasController::class, 'store']);
Route::patch('/komunitas/{id}/status', [KomunitasController::class, 'changeStatus']);
Route::put('/komunitas/{id}', [KomunitasController::class, 'update']);


use App\Http\Controllers\EventController;

Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);
Route::put('/events/{id}', [EventController::class, 'update']);
Route::patch('/events/{id}/status', [EventController::class, 'changeStatus']);
Route::put('/events/{id}', [EventController::class, 'update']);

use App\Http\Controllers\AdminUserController;

Route::get('/users', [AdminUserController::class, 'index']);
Route::patch('/users/{id}/status', [AdminUserController::class, 'changeStatus']);

use App\Http\Controllers\AdminController;
Route::get('/admin/stats', [AdminController::class, 'getStats']);

