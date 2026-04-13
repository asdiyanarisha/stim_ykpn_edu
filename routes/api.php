<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// ======================================================================
// Auth Routes (Public — tidak memerlukan token)
// ======================================================================
Route::prefix('auth')->group(function () {
    // Login — menghasilkan JWT token
    Route::post('/login', [AuthController::class, 'login']);

    // Validate Token — cek apakah token masih valid
    Route::post('/validate-token', [AuthController::class, 'validateToken']);
});

// ======================================================================
// Protected Routes (memerlukan JWT token yang valid)
// ======================================================================
Route::middleware('jwt.auth')->group(function () {
    // Me — mendapatkan info user dari token
    Route::get('/auth/me', [AuthController::class, 'me']);

    // Teacher Management
    Route::get('/teachers', [TeacherController::class, 'index']);
    Route::get('/teachers/{id}', [TeacherController::class, 'show']);
    Route::post('/teachers', [TeacherController::class, 'store']);
    Route::post('/teachers/{id}', [TeacherController::class, 'update']);
});
