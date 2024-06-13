<?php

use App\Http\Controllers\AuthController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');


// Ruta protegida (dashboard o inicio)
Route::get('/dashboard', function () {
    return view('dashboard'); // Crea esta vista o ajusta según lo necesario
})->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});


