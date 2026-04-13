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
