<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/unauthenticated', function () {
    return view('unauthenticated');
});
Route::get('/masterData/teacher', function () {
    return view('teacher');
});
Route::get('/masterData/teacher/create', function () {
    return view('teacher-form');
});
Route::get('/masterData/teacher/show/{id}', function ($id) {
    return view('teacher-show');
});
Route::get('/masterData/teacher/edit/{id}', function ($id) {
    return view('teacher-edit');
});

Route::get('/content/banner', function () {
    return view('banner');
});

Route::get('/content/berita', function () {
    return view('berita');
});

Route::get('/content/berita/create', function () {
    return view('news-form');
});

Route::get('/content/berita/show/{id}', function ($id) {
    return view('news-show');
});

Route::get('/content/berita/edit/{id}', function ($id) {
    return view('news-edit');
});

Route::get('/content/lowongan-kerja', function () {
    return view('job-vacancies');
});

Route::get('/content/lowongan-kerja/create', function () {
    return view('job-vacancies-form');
});

Route::get('/content/lowongan-kerja/edit/{id}', function ($id) {
    return view('job-vacancies-edit');
});

Route::get('/content/logo-sertifikasi', function () {
    return view('certification-logos');
});

Route::get('/content/logo-sertifikasi/create', function () {
    return view('certification-logos-form');
});

Route::get('/content/logo-sertifikasi/edit/{id}', function ($id) {
    return view('certification-logos-edit');
});

Route::get('/content/profil/greeting', function () {
    return view('greeting-chief-form');
});

Route::get('/content/profil/core-values', function () {
    return view('core-values-form');
});

Route::get('/content/profil/history', function () {
    return view('history-form');
});

Route::get('/content/profil/logo-symbol', function () {
    return view('logo-symbol-form');
});

Route::get('/content/profil/facility', function () {
    return view('facility-form');
});

Route::get('/content/profil/spmi-akreditasi', function () {
    return view('spmi-akreditasi-form');
});

Route::get('/academic/programs/goals', function () {
    return view('academic-goal-form');
});

Route::get('/academic/programs/how-to-achieve', function () {
    return view('academic-goal-achieve-form');
});

Route::get('/academic/programs/study-load', function () {
    return view('study-load-form');
});

Route::get('/academic/programs/sks', function () {
    return view('sks-form');
});

Route::get('/academic/programs/level-period-study', function () {
    return view('level-period-study-form');
});

Route::get('/academic/programs/academic-activities', function () {
    return view('academic-activities-form');
});

Route::get('/academic/programs/academic-advisor', function () {
    return view('academic-advisor-form');
});

Route::get('/academic/programs/academic-sanction', function () {
    return view('academic-sanction-form');
});

Route::get('/content/academic-calendar', function () {
    return view('academic-calendar-form');
});

Route::get('/academic/provision/attendance', function () {
    return view('attendance-lecture-form');
});

Route::get('/academic/provision/code-conduct', function () {
    return view('code-conduct-form');
});

Route::get('/academic/provision/class-capacity', function () {
    return view('class-capacity-form');
});

Route::get('/academic/provision/attendance-count', function () {
    return view('attendance-count-form');
});

Route::get('/academic/provision/evaluation-system', function () {
    return view('evaluation-system-form');
});

Route::get('/academic/provision/seminar-proposal', function () {
    return view('seminar-proposal-form');
});

Route::get('/academic/graduation-exam-condition/exam', function () {
    return view('exam-form');
});

Route::get('/academic/graduation-exam-condition/exam-rules', function () {
    return view('exam-rules-form');
});

Route::get('/academic/graduation-exam-condition/graduation', function () {
    return view('graduation-form');
});

Route::get('/academic/graduation-exam-condition/yudisium', function () {
    return view('yudisium-form');
});

Route::get('/academic/graduation-exam-condition/graduation-announcement', function () {
    return view('graduation-announcement-form');
});

Route::get('/academic/library', function () {
    return view('academic-library-form');
});

Route::get('/content/profil/achievement', function () {
    return view('achievements');
});

Route::get('/content/profil/achievement/create', function () {
    return view('achievement-form');
});

Route::get('/content/profil/achievement/edit/{id}', function ($id) {
    return view('achievement-edit');
});

Route::get('/content/profil/achievement/show/{id}', function ($id) {
    return view('achievement-show');
});

Route::get('/content/banner/show/{id}', function ($id) {
    return view('banner-show');
});

Route::get('/content/banner/create', function () {
    return view('banner-form');
});
Route::get('/content/banner/edit/{id}', function ($id) {
    return view('banner-edit');
});

// Jurnal Penelitian
Route::get('/research/journal', fn() => view('journal'))->name('journal');
Route::get('/research/journal/create', fn() => view('journal-form'))->name('journal.create');
Route::get('/research/journal/show/{id}', fn() => view('journal-show'))->name('journal.show');
Route::get('/research/journal/edit/{id}', fn() => view('journal-edit'))->name('journal.edit');

// Kegiatan Mahasiswa
Route::get('/student/activity', fn() => view('student-activity'))->name('student.activity');
Route::get('/student/activity/create', fn() => view('student-activity-form'))->name('student.activity.create');
Route::get('/student/activity/show/{id}', fn() => view('student-activity-show'))->name('student.activity.show');
Route::get('/student/activity/edit/{id}', fn() => view('student-activity-edit'))->name('student.activity.edit');

// Student UKM
Route::get('/student/ukm', fn() => view('student-ukm'))->name('student.ukm');
Route::get('/student/ukm/create', fn() => view('student-ukm-form'))->name('student.ukm.create');
Route::get('/student/ukm/show/{id}', fn() => view('student-ukm-show'))->name('student.ukm.show');
Route::get('/student/ukm/edit/{id}', fn() => view('student-ukm-edit'))->name('student.ukm.edit');

// Testimony Alumni
Route::get('/student/testimony', fn() => view('student-testimony'))->name('student.testimony');
Route::get('/student/testimony/create', fn() => view('student-testimony-form'))->name('student.testimony.create');
Route::get('/student/testimony/show/{id}', fn() => view('student-testimony-show'))->name('student.testimony.show');
Route::get('/student/testimony/edit/{id}', fn() => view('student-testimony-edit'))->name('student.testimony.edit');

// Campus Live Video
Route::get('/campus-life/video', fn() => view('campus-live-video'))->name('campus.live.video');
Route::get('/campus-life/video/create', fn() => view('campus-live-video-form'))->name('campus.live.video.create');
Route::get('/campus-life/video/show/{id}', fn() => view('campus-live-video-show'))->name('campus.live.video.show');
Route::get('/campus-life/video/edit/{id}', fn() => view('campus-live-video-edit'))->name('campus.live.video.edit');

// Lodging Information
Route::get('/campus-life/lodging-information', fn() => view('lodging-information-form'))->name('campus.live.lodging.information');

// PMB
Route::get('/pmb/scholarship', fn() => view('pmb-scholarship-form'))->name('pmb.scholarship');
Route::get('/pmb/program-excellence', fn() => view('pmb-program-excellence-form'))->name('pmb.program.excellence');
Route::get('/pmb/program-reguler', fn() => view('pmb-program-reguler-form'))->name('pmb.program.reguler');
Route::get('/pmb/program-extensi', fn() => view('pmb-program-extensi-form'))->name('pmb.program.extensi');

// Roles Management
Route::get('/roles', fn() => view('role'))->name('role.index');
Route::get('/roles/create', fn() => view('role-form'))->name('role.create');
Route::get('/roles/edit/{id}', fn() => view('role-edit'))->name('role.edit');

// User Management
Route::get('/user', fn() => view('user'))->name('user.index');
Route::get('/user/create', fn() => view('user-form'))->name('user.create');
Route::get('/user/show/{id}', fn() => view('user-show'))->name('user.show');
Route::get('/user/edit/{id}', fn() => view('user-edit'))->name('user.edit');

// Brochure Management
Route::get('/brochure', fn() => view('brochure'))->name('brochure.index');
Route::get('/brochure/create', fn() => view('brochure-form'))->name('brochure.create');
Route::get('/brochure/show/{id}', fn() => view('brochure-show'))->name('brochure.show');
Route::get('/brochure/edit/{id}', fn() => view('brochure-edit'))->name('brochure.edit');

// Public File Management
Route::get('/public-files', fn() => view('public-files'))->name('public-files.index');
Route::get('/public-files/create', fn() => view('public-files-form'))->name('public-files.create');
Route::get('/public-files/show/{id}', fn() => view('public-files-show'))->name('public-files.show');
Route::get('/public-files/edit/{id}', fn() => view('public-files-edit'))->name('public-files.edit');

// Voucher Management
Route::get('/voucher', fn() => view('voucher'))->name('voucher.index');
Route::get('/voucher/create', fn() => view('voucher-form'))->name('voucher.create');
Route::get('/voucher/show/{id}', fn() => view('voucher-show'))->name('voucher.show');
Route::get('/voucher/edit/{id}', fn() => view('voucher-edit'))->name('voucher.edit');

// Academic School Year Management
Route::get('/academic/school-year', fn() => view('academic-school-year'))->name('academic-school-year.index');
Route::get('/academic/school-year/create', fn() => view('academic-school-year-form'))->name('academic-school-year.create');
Route::get('/academic/school-year/show/{id}', fn() => view('academic-school-year-show'))->name('academic-school-year.show');
Route::get('/academic/school-year/edit/{id}', fn() => view('academic-school-year-edit'))->name('academic-school-year.edit');

// Program Study Management
Route::get('/academic/programs', fn() => view('program-study'))->name('program-study.index');
Route::get('/academic/programs/create', fn() => view('program-study-form'))->name('program-study.create');
Route::get('/academic/programs/show/{id}', fn() => view('program-study-show'))->name('program-study.show');
Route::get('/academic/programs/edit/{id}', fn() => view('program-study-edit'))->name('program-study.edit');

// Payment Settings
Route::get('/payment_settings', fn() => view('payment-setting-form'))->name('payment-settings');
