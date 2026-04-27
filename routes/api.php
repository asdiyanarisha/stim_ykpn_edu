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
use App\Http\Controllers\Api\AcademicAdvisorController;
use App\Http\Controllers\Api\AcademicSanctionController;
use App\Http\Controllers\Api\AcademicCalendarController;
use App\Http\Controllers\Api\AttendanceLectureController;
use App\Http\Controllers\Api\CodeConductController;
use App\Http\Controllers\Api\ClassCapacityController;
use App\Http\Controllers\Api\AttendanceCountController;
use App\Http\Controllers\Api\EvaluationSystemController;
use App\Http\Controllers\Api\SeminarProposalController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ExamRuleController;
use App\Http\Controllers\Api\GraduationController;
use App\Http\Controllers\Api\YudisiumController;
use App\Http\Controllers\Api\GraduationAnnouncementController;
use App\Http\Controllers\Api\AcademicLibraryController;
use App\Http\Controllers\Api\ArticleTeacherController;
use App\Http\Controllers\Api\StudentActivityController;
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

    // Content Management - Dosen Pembimbing
    Route::get('/academic-advisor', [AcademicAdvisorController::class, 'show']);
    Route::post('/academic-advisor', [AcademicAdvisorController::class, 'update']);

    // Content Management - Sanksi Akademik
    Route::get('/academic-sanction', [AcademicSanctionController::class, 'show']);
    Route::post('/academic-sanction', [AcademicSanctionController::class, 'update']);

    // Content Management - Kalender Akademik
    Route::get('/academic-calendar', [AcademicCalendarController::class, 'show']);
    Route::post('/academic-calendar', [AcademicCalendarController::class, 'update']);

    // Content Management - Kehadiran Kuliah
    Route::get('/attendance-lecture', [AttendanceLectureController::class, 'show']);
    Route::post('/attendance-lecture', [AttendanceLectureController::class, 'update']);

    // Content Management - Tata Tertib Kuliah
    Route::get('/code-conduct', [CodeConductController::class, 'show']);
    Route::post('/code-conduct', [CodeConductController::class, 'update']);

    // Content Management - Kapasitas Kelas
    Route::get('/class-capacity', [ClassCapacityController::class, 'show']);
    Route::post('/class-capacity', [ClassCapacityController::class, 'update']);

    // Content Management - Jumlah Kehadiran
    Route::get('/attendance-count', [AttendanceCountController::class, 'show']);
    Route::post('/attendance-count', [AttendanceCountController::class, 'update']);

    // Content Management - Sistem Evaluasi
    Route::get('/evaluation-system', [EvaluationSystemController::class, 'show']);
    Route::post('/evaluation-system', [EvaluationSystemController::class, 'update']);

    // Content Management - Proposal Seminar
    Route::get('/seminar-proposal', [SeminarProposalController::class, 'show']);
    Route::post('/seminar-proposal', [SeminarProposalController::class, 'update']);

    // Content Management - Ketentuan Ujian
    Route::get('/exam', [ExamController::class, 'show']);
    Route::post('/exam', [ExamController::class, 'update']);

    // Content Management - Tata Tertib Ujian
    Route::get('/exam-rules', [ExamRuleController::class, 'show']);
    Route::post('/exam-rules', [ExamRuleController::class, 'update']);

    // Content Management - Kelulusan
    Route::get('/graduation', [GraduationController::class, 'show']);
    Route::post('/graduation', [GraduationController::class, 'update']);

    // Content Management - Yudisium
    Route::get('/yudisium', [YudisiumController::class, 'show']);
    Route::post('/yudisium', [YudisiumController::class, 'update']);

    // Content Management - Pengumuman Kelulusan
    Route::get('/graduation-announcement', [GraduationAnnouncementController::class, 'show']);
    Route::post('/graduation-announcement', [GraduationAnnouncementController::class, 'update']);

    // Content Management - Perpustakaan
    Route::get('/academic-library', [AcademicLibraryController::class, 'show']);
    Route::post('/academic-library', [AcademicLibraryController::class, 'update']);

    // Research Journals
    Route::get('/research-journals', [ArticleTeacherController::class, 'index']);
    Route::get('/research-journals/{id}', [ArticleTeacherController::class, 'show']);
    Route::post('/research-journals', [ArticleTeacherController::class, 'store']);
    Route::post('/research-journals/bulk-delete', [ArticleTeacherController::class, 'bulkDestroy']);
    
    // Student Activity
    Route::get('/student-activities', [StudentActivityController::class, 'index']);
    Route::post('/student-activities', [StudentActivityController::class, 'store']);
    Route::get('/student-activities/{id}', [StudentActivityController::class, 'show']);
    Route::post('/student-activities/{id}', [StudentActivityController::class, 'update']);
    Route::delete('/student-activities/{id}', [StudentActivityController::class, 'destroy']);
    Route::post('/student-activities/bulk-delete', [StudentActivityController::class, 'bulkDestroy']);
    Route::post('/research-journals/{id}', [ArticleTeacherController::class, 'update']);
    Route::delete('/research-journals/{id}', [ArticleTeacherController::class, 'destroy']);
});
