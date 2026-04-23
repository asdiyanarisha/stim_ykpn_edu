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
use App\Http\Controllers\Api\FacilityController;
use App\Http\Controllers\Api\AchievementController;
use App\Http\Controllers\Api\SpmiAkreditasiController;
use App\Http\Controllers\Api\AcademicGoalController;
use App\Http\Controllers\Api\AcademicGoalAchieveController;
use App\Http\Controllers\Api\StudyLoadController;
use App\Http\Controllers\Api\SksController;
use App\Http\Controllers\Api\LevelPeriodStudyController;
use App\Http\Controllers\Api\AcademicActivityController;
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

    // Content Management - Facility
    Route::get('/facility', [FacilityController::class, 'show']);
    Route::post('/facility', [FacilityController::class, 'update']);

    // Content Management - Achievement
    Route::get('/achievements', [AchievementController::class, 'index']);
    Route::get('/achievements/{id}', [AchievementController::class, 'show']);
    Route::post('/achievements', [AchievementController::class, 'store']);
    Route::post('/achievements/bulk-delete', [AchievementController::class, 'bulkDestroy']);
    Route::post('/achievements/{id}', [AchievementController::class, 'update']);
    Route::delete('/achievements/{id}', [AchievementController::class, 'destroy']);

    // Content Management - SPMI & Akreditasi
    Route::get('/spmi-akreditasi', [SpmiAkreditasiController::class, 'show']);
    Route::post('/spmi-akreditasi', [SpmiAkreditasiController::class, 'update']);

    // Content Management - Sasaran Pendidikan (Academic Goals)
    Route::get('/academic-goals', [AcademicGoalController::class, 'show']);
    Route::post('/academic-goals', [AcademicGoalController::class, 'update']);

    // Content Management - Cara Mencapai Sasaran (Academic Goal Achieve)
    Route::get('/academic-goal-achieve', [AcademicGoalAchieveController::class, 'show']);
    Route::post('/academic-goal-achieve', [AcademicGoalAchieveController::class, 'update']);

    // Content Management - Beban Studi
    Route::get('/study-load', [StudyLoadController::class, 'show']);
    Route::post('/study-load', [StudyLoadController::class, 'update']);

    // Content Management - SKS
    Route::get('/sks', [SksController::class, 'show']);
    Route::post('/sks', [SksController::class, 'update']);

    // Content Management - Jenjang dan Masa Studi
    Route::get('/level-period-study', [LevelPeriodStudyController::class, 'show']);
    Route::post('/level-period-study', [LevelPeriodStudyController::class, 'update']);

    // Content Management - Kegiatan Akademik
    Route::get('/academic-activities', [AcademicActivityController::class, 'show']);
    Route::post('/academic-activities', [AcademicActivityController::class, 'update']);
});
