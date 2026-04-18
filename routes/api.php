<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\ContentBannerController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\JobVacancyController;
use App\Http\Controllers\Api\CertificationLogoController;
use App\Http\Controllers\Api\GreetingChiefController;
use App\Http\Controllers\Api\CoreValueController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\LogoSymbolController;
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
    Route::delete('/teachers/{id}', [TeacherController::class, 'destroy']);

    // Content Management - Banner
    Route::get('/banners', [ContentBannerController::class, 'index']);
    Route::get('/banners/{id}', [ContentBannerController::class, 'show']);
    Route::post('/banners', [ContentBannerController::class, 'store']);
    Route::post('/banners/{id}', [ContentBannerController::class, 'update']);
    Route::delete('/banners/{id}', [ContentBannerController::class, 'destroy']);
    Route::post('/banners/bulk-delete', [ContentBannerController::class, 'bulkDestroy']);

    // Content Management - News
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{id}', [NewsController::class, 'show']);
    Route::post('/news', [NewsController::class, 'store']);
    Route::post('/news/bulk-delete', [NewsController::class, 'bulkDestroy']);
    Route::post('/news/bulk-publish', [NewsController::class, 'bulkPublish']);
    Route::post('/news/{id}', [NewsController::class, 'update']);
    Route::delete('/news/{id}', [NewsController::class, 'destroy']);

    // Content Management - Job Vacancies
    Route::get('/job-vacancies', [JobVacancyController::class, 'index']);
    Route::get('/job-vacancies/{id}', [JobVacancyController::class, 'show']);
    Route::post('/job-vacancies', [JobVacancyController::class, 'store']);
    Route::post('/job-vacancies/bulk-delete', [JobVacancyController::class, 'bulkDestroy']);
    Route::post('/job-vacancies/bulk-publish', [JobVacancyController::class, 'bulkPublish']);
    Route::post('/job-vacancies/{id}', [JobVacancyController::class, 'update']);
    Route::delete('/job-vacancies/{id}', [JobVacancyController::class, 'destroy']);

    // Content Management - Certification Logos
    Route::get('/certification-logos', [CertificationLogoController::class, 'index']);
    Route::get('/certification-logos/{id}', [CertificationLogoController::class, 'show']);
    Route::post('/certification-logos', [CertificationLogoController::class, 'store']);
    Route::post('/certification-logos/bulk-delete', [CertificationLogoController::class, 'bulkDestroy']);
    Route::post('/certification-logos/{id}', [CertificationLogoController::class, 'update']);
    Route::delete('/certification-logos/{id}', [CertificationLogoController::class, 'destroy']);

    // Content Management - Greeting Chief
    Route::get('/greeting-chief', [GreetingChiefController::class, 'show']);
    Route::post('/greeting-chief', [GreetingChiefController::class, 'update']);

    // Content Management - Core Values
    Route::get('/core-values', [CoreValueController::class, 'show']);
    Route::post('/core-values', [CoreValueController::class, 'update']);

    // Content Management - History
    Route::get('/history', [HistoryController::class, 'show']);
    Route::post('/history', [HistoryController::class, 'update']);

    // Content Management - Logo Symbol
    Route::get('/logo-symbol', [LogoSymbolController::class, 'show']);
    Route::post('/logo-symbol', [LogoSymbolController::class, 'update']);
});
