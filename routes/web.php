<?php

use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta protegida (dashboard o inicio)
Route::get('/dashboard', function () {
    return view('dashboard'); // Crea esta vista o ajusta según lo necesario
})->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});
