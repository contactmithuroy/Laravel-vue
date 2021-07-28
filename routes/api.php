<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicAPIController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::resource('/category',CategoryController::class);
    Route::resource('/product',ProductController::class);
    
    Route::post('/user',[AuthController::class,'update_user']);

});

Route::get('/products',[PublicAPIController::class,'getProduct']);
Route::get('/products/search/{search}',[PublicAPIController::class,'searchData']);
Route::post('/products/clickSearch/{clickSearch}',[PublicAPIController::class,'clickSearch']);