<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/products/add', [App\Http\Controllers\ProductController::Class,'store']);
Route::post('/products/update', [App\Http\Controllers\ProductController::Class,'update']);
Route::delete('/products/delete/{id}', [App\Http\Controllers\ProductController::Class,'delete']);
Route::get('/products/all', [App\Http\Controllers\ProductController::Class,'indexAll']);
Route::get('/products/edit/{id}', [App\Http\Controllers\ProductController::Class,'edit']);

Route::get('countries',function(){
    return \DB::table("countries")->get();
});
// 
Route::get('regions/{countory_id}',function($countory_id){
    return \DB::table("regions")->where('countory_id',$countory_id)->get();
});

Route::fallback(function () {
    return response()->json(['Status' => false, 'ErrorCode' => "RT404", 'Error' => 'Route does not exist']);
});


