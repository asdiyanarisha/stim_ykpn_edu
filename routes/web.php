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
