<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use AmrShawky\LaravelCurrency\Facade\Currency;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rate', function () {
    return Currency::convert()
    ->from('USD')
    ->to('PKR')
    ->amount(1)
    ->date(now())
    ->round(2)
    ->get();
    
});

Route::get('user/{id}',[PostController::class,'index']);
