<?php
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\SolicitudHasTrabajadorController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\TipoMantenimientoController;
use App\Http\Controllers\TipoMovimientoController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;


// routes/web.php

use App\Http\Controllers\RoleController;

Route::resource('roles', RoleController::class);

Route::get('solicitudes/{id}/asignaciones', [SolicitudHasTrabajadorController::class, 'showBySolicitud'])->name('solicitudes.asignaciones');


Route::resource('tipomantenimientos', TipoMantenimientoController::class);

Route::get('solicitudes_has_trabajadores', [SolicitudHasTrabajadorController::class, 'index'])->name('solicitudes_has_trabajadores.index');


// Definición de las rutas
Route::resource('areas', AreaController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('estados', EstadoController::class);
Route::resource('movimientos', MovimientoController::class);



Route::resource('solicitudes', SolicitudController::class);
Route::resource('solicitudes_has_trabajadores', SolicitudHasTrabajadorController::class);
Route::resource('subcategorias', SubcategoriaController::class);
Route::resource('tipoMantenimiento', TipoMantenimientoController::class);
Route::resource('tipomovimientos', TipoMovimientoController::class);
Route::resource('trabajadores', TrabajadorController::class);

Route::resource('usuarios', UsuarioController::class);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware([])->group(function () {
    Route::get('/home', [HomeController::class, 'mostrarVista'])->name('home');
    Route::resource('items', ItemController::class);
});

Route::get('/', function () {
    return view('welcome');
});
