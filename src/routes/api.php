<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController ;
use App\Http\Controllers\API\CategoriesController ;
use App\Http\Controllers\API\ProductController ;



Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login',[AuthController::class , 'login']);
    Route::post('logout', [AuthController::class , 'logout']);
    Route::post('refresh', [AuthController::class , 'refresh']);
    Route::get('profile', [AuthController::class , 'me']);

});

Route::middleware('auth')->post('/category',[CategoriesController ::class,'create'] );
Route::get('/category/{category_id?}',[CategoriesController ::class,'get'] );
Route::middleware('auth')->put('/category/{category_id}',[CategoriesController ::class,'update'] );
Route::middleware('auth')->delete('/category/{category_id}',[CategoriesController ::class,'delete'] );

Route::middleware('auth')->post('/product',[ProductController ::class,'create'] );
Route::get('/product/{product_id?}',[ProductController ::class,'get'] );
Route::middleware('auth')->put('/product/{product_id}',[ProductController ::class,'update'] );
Route::middleware('auth')->delete('/product/{product_id}',[ProductController ::class,'delete'] );
