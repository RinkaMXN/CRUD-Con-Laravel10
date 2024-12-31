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
Route::get("/welcome", [LibrosController::class, "welcome"])->name("welcome");
Route::get("/index-libros", [LibrosController::class, "index"])->name("index");
Route::post("/create-libros", [LibrosController::class, "create"])->name("create");
Route::post("/update-libros", [LibrosController::class, "update"])->name("update");
Route::post("/delete-libros", [LibrosController::class, "delete"])->name("delete");