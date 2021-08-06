<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\BusinessController;
use App\Http\Controllers\API\BusinessUserController;

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

Route::post('/user/register', [UserController::Class,'register']);
Route::post('/user/login', [UserController::Class,'login'])->name('login');
Route::get('/user/verify/{userid}', [UserController::Class,'verify']);

Route::get('/test',function(){
    return "OK";
});


Route::group(['middleware' => ['auth:api']], function (){
    
    Route::get('/user/GetSingleUser', [UserController::Class,'GetSingleUser']);
    Route::post('/user/update/{userid}', [UserController::Class,'update']);

    Route::post('/business/create', [BusinessController::Class,'store']);
    Route::post('/business/update', [BusinessController::Class,'update']);
    Route::get('/business/getUserBusiness', [BusinessController::Class,'getUserBusiness']);

    Route::get('/business/testFunction', [BusinessController::Class,'testFunction']);

    // Route::post('/business_user/add', [BusinessUserController::Class,'store']);
    Route::get('/business_user/all/{businessid}', [BusinessUserController::Class,'indexAll']);

    Route::post('/product/add', [App\Http\Controllers\API\ProductController::Class,'store']);
    Route::get('/product/all', [App\Http\Controllers\API\ProductController::Class,'indexAll']);


});

Route::post('/products/add', [App\Http\Controllers\API\ProductController::Class,'store']);
Route::post('/products/update', [App\Http\Controllers\API\ProductController::Class,'update']);
Route::delete('/products/delete/{id}', [App\Http\Controllers\API\ProductController::Class,'delete']);
Route::get('/products/all', [App\Http\Controllers\API\ProductController::Class,'indexAll']);
Route::get('/products/edit/{id}', [App\Http\Controllers\API\ProductController::Class,'edit']);


Route::fallback(function () {
    return response()->json(['Status' => false, 'ErrorCode' => "RT404", 'Error' => 'Route does not exist']);
});
