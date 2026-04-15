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

Route::get('/content/banner/show/{id}', function ($id) {
    return view('banner-show');
});

Route::get('/content/banner/create', function () {
    return view('banner-form');
});
Route::get('/content/banner/edit/{id}', function ($id) {
    return view('banner-edit');
});
