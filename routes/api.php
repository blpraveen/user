<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DineController;
use App\Http\Controllers\API\LoginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:api')->group(function(){
 
Route::post('dine/create_order',[DineController::class, 'creatOrder'])->name('dine.create.order')->middleware('permission:create-order');
Route::get('dine/aggregate',[DineController::class, 'aggregate'])->name('dine.aggregate')->middleware('permission:create-order');
Route::get('dine/sold',[DineController::class, 'sold'])->name('dine.sod')->middleware('permission:create-order');
  
});