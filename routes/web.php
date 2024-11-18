<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibrosController;



Route::get('/', function () {
    return view('plantilla.welcome');
});



Route::get("/index-libros", [LibrosController::class, "index"])->name("index");
Route::get("/agregar-libro", [LibrosController::class, "create"])->name("create");
