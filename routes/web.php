<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('',[ProductController::class,'index'])->name('listProduct');
Route::get('/create',[ProductController::class,'create']);
Route::post('/create',[ProductController::class,'store']);

Route::get('/add/{id}',[ShoppingCartController::class,'add']);
Route::get('/show',[ShoppingCartController::class,'show']);
Route::get('/remove/{rowId}',[ShoppingCartController::class,'remove']);
Route::get('/update',[ShoppingCartController::class,'update']);
Route::get('/destroy',[ShoppingCartController::class,'destroy']);
Route::post('/order/save',[OrderController::class,'save'])->name('saveOrder');
