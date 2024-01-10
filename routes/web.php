<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
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
Auth::routes();

Route::get("/",[UsersController::class,'index'])->name("index");
Route::post("/update/{user}",[UsersController::class,'update'])->name("update");
Route::post("/create",[UsersController::class,'create'])->name("create");
Route::delete("/delete/{user}",[UsersController::class,'delete'])->name('delete');
