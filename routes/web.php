<?php

use App\Http\Controllers\{
    AreaController, CategoriaController, EstadoController, ItemController, MovimientoController,
    SolicitudController, SolicitudHasTrabajadorController, SubcategoriaController, 
    TipoMantenimientoController, TipoMovimientoController, TrabajadorController, UsuarioController, 
    AuthController, HomeController, RoleController
};
use Illuminate\Support\Facades\Route;

Route::resource('roles', RoleController::class);

Route::get('solicitudes/{id}/asignaciones', [SolicitudHasTrabajadorController::class, 'showBySolicitud'])->name('solicitudes.asignaciones');

Route::resource('tipomantenimientos', TipoMantenimientoController::class);
Route::get('solicitudes_has_trabajadores', [SolicitudHasTrabajadorController::class, 'index'])->name('solicitudes_has_trabajadores.index');

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

    // Aquí agregamos la ruta de búsqueda de ítems
    Route::get('/items/search', [ItemController::class, 'search'])->name('items.search');

Route::middleware([])->group(function () {
    Route::get('/home', [HomeController::class, 'mostrarVista'])->name('home');
    Route::resource('items', ItemController::class);

});

Route::get('/', function () {
    return view('welcome');
});
