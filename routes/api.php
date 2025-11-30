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
| PUBLIC ROUTES (TANPA LOGIN)
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// homepage user
Route::get('/homepage-berita', [BeritaController::class, 'homepage']);



/*
|--------------------------------------------------------------------------
| USER AUTH ROUTES (BUTUH LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum'])->group(function () {

    // user profile
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    // USER dapat melihat komunitas & event, tapi tidak update admin
    Route::get('/komunitas', [KomunitasController::class, 'index']);
    Route::get('/events', [EventController::class, 'index']);

    // USER juga boleh melihat berita
    Route::get('/berita', [BeritaController::class, 'index']);
});



/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (BUTUH ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {

    // ADMIN DASHBOARD
    Route::get('/admin/stats', [AdminController::class, 'getStats']);

    // ADMIN - USERS
    Route::get('/users', [AdminUserController::class, 'index']);
    Route::patch('/users/{id}/status', [AdminUserController::class, 'changeStatus']);

    // ADMIN - BERITA
    Route::post('/berita', [BeritaController::class, 'store']);
    Route::put('/berita/{id}', [BeritaController::class, 'update']);
    Route::put('/berita/{id}/archive', [BeritaController::class, 'archive']);
    Route::put('/berita/{id}/published', [BeritaController::class, 'publish']);

    // ADMIN - KOMUNITAS
    Route::post('/komunitas', [KomunitasController::class, 'store']);
    Route::patch('/komunitas/{id}/status', [KomunitasController::class, 'changeStatus']);
    Route::put('/komunitas/{id}', [KomunitasController::class, 'update']);

    // ADMIN - EVENTS
    Route::post('/events', [EventController::class, 'store']);
    Route::put('/events/{id}', [EventController::class, 'update']);
    Route::patch('/events/{id}/status', [EventController::class, 'changeStatus']);
});
