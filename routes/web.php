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
Route::post("/update",[UsersController::class,'update']);
Route::post("/create",[UsersController::class,'create']);
Route::delete("/delete",[UsersController::class,'delete'])->name('delete');
