<?php


use App\Http\Controllers\LibrosController;
use Illuminate\Support\Facades\Route;
use App\Models\libros;
use App\Models\generos;


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
    return view('auth.login');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/hola', function () {
        return view('crud.hola');
    })->name('hola');
});


//CRUD DE LIBROS
Route::get('ventana_reporte_de_libro',[LibrosController::class,'ventana_reporte_de_libro'])->name('ventana_reporte_de_libro');
Route::get('ventana_alta_de_libro',[LibrosController::class,'ventana_alta_de_libro'])->name('ventana_alta_de_libro');
Route::POST('ventana_guardar_libro',[LibrosController::class,'ventana_guardar_libro'])->name('ventana_guardar_libro');
Route::get('ventana_modifica_libro/{IdLibro}',[LibrosController::class,'ventana_modifica_libro'])->name('ventana_modifica_libro');
Route::POST('ventana_guarda_cambios',[LibrosController::class,'ventana_guarda_cambios'])->name('ventana_guarda_cambios');
Route::get('ventana_borra_libro/{IdLibro}',[LibrosController::class,'ventana_borra_libro'])->name('ventana_borra_libro');
Route::get('ventana_activa_libro/{IdLibro}',[LibrosController::class,'ventana_activa_libro'])->name('ventana_activa_libro');
Route::get('ventana_desactiva_libro/{IdLibro}',[LibrosController::class,'ventana_desactiva_libro'])->name('ventana_desactiva_libro');
