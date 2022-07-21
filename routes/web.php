<?php

use App\Http\Controllers\favorite;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieResources;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

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

route::get('/',[MovieResources::class,'index'])->name('home'); 
route::post('/like',[favorite::class,'favorite'])->middleware('auth');
route::put('/like/{id}/update',[favorite::class,'updatefavorite'])->middleware('auth');
route::delete('/like/{id}/delete',[favorite::class,'deletefavorite'])->middleware('auth');
route::get('/detail/{id}',[MovieResources::class,'show'])->name('home'); 
Route::get('/api',[OrderController::class,'createCustomer']);
Route::get('/get',[OrderController::class,'getCustomer']);
Route::post('/pay',[OrderController::class,'store']);

route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout'])->name('logout');  
Route::get('/register',[LoginController::class,'indexRegister'])->name('register');
route::post('/register',[LoginController::class,'register']);


