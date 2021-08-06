<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\MyEvent;
use App\Http\Controllers\MessageController;


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
Route::get('/send', function (){
    event(new MyEvent("Hello Event"));
    return "The event is called";
});
Route::post('message',[MessageController::class, 'sendMessage']);
