<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibrosController;

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
    return view('plantilla.welcome');
});
Route::get("/index-libros", [LibrosController::class, "index"])->name("index");
Route::get("/agregar-libros", [LibrosController::class, "agregar"])->name("agregar");
Route::post("/create-libros", [LibrosController::class, "create"])->name("create");