<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
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

Route::post('get-private-message-notifications', [App\Http\Controllers\MessageController::class, 'getUserNotifications']);
Route::post('get-private-messages', [App\Http\Controllers\MessageController::class, 'getPrivateMessages']);
Route::post('get-private-message', [App\Http\Controllers\MessageController::class, 'getUserNotificationById']);
Route::post('get-private-message-sent', [App\Http\Controllers\MessageController::class, 'getUserNotificationSent']);
Route::post('get-private-message', [App\Http\Controllers\MessageController::class, 'sendMessage']);