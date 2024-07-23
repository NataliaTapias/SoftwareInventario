<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AreaController, CategoriaController, EstadoController, ItemController, MovimientoController,
    SolicitudController, SolicitudHasTrabajadorController, SubcategoriaController, 
    TipoMantenimientoController, TipoMovimientoController, TrabajadorController, UsuarioController, 
    AuthController, HomeController, RoleController,ExportController,InformesController
};

Route::middleware(['auth'])->group(function () {
    Route::get('/export-movimientos', [ExportController::class, 'exportMovimientos'])->name('export.movimientos');
    Route::resource('roles', RoleController::class);
    Route::resource('areas', AreaController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('estados', EstadoController::class);
    Route::resource('movimientos', MovimientoController::class);
    Route::resource('solicitudes', SolicitudController::class);
    Route::resource('solicitudes_has_trabajadores', SolicitudHasTrabajadorController::class);
    Route::resource('subcategorias', SubcategoriaController::class);
    Route::resource('tipomantenimientos', TipoMantenimientoController::class);
    Route::resource('tipomovimientos', TipoMovimientoController::class);
    Route::resource('trabajadores', TrabajadorController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('items', ItemController::class);
    Route::resource('informes', InformesController::class);

    Route::get('solicitudes/{id}/asignaciones', [SolicitudHasTrabajadorController::class, 'showBySolicitud'])->name('solicitudes.asignaciones');
    Route::get('solicitudes_has_trabajadores', [SolicitudHasTrabajadorController::class, 'index'])->name('solicitudes_has_trabajadores.index');
    Route::get('/home', [HomeController::class, 'mostrarVista'])->name('home');
    Route::get('/items/search', [ItemController::class, 'search'])->name('items.search');
});

// Rutas para autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta para la vista de bienvenida
Route::get('/', function () {
    return view('login');
});
