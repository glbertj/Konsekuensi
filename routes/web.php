<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\bBoardController;
use App\Http\Controllers\mainpageController;
use App\Http\Controllers\bBoardDelController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/buletin',[mainpageController::class,'index'] );

Route::get('/bBoardAdd',[bBoardController::class,'index']);
Route::post('/bBoardAdd',[bBoardController::class,'store']);

Route::get('bBoardDelete',[bBoardDelController::class,'index']);
Route::post('/bBoardDelete',[bBoardDelController::class,'delete']);
