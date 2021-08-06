<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Input\Input;

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
Route::get('/form', function () {
    return view('form');

});
Route::get('/data',function () {
    $data = [
        'amount'  => $_GET['am']?:0,
        'fdate'  => $_GET['fdate']?:0,
        'water'  => $_GET['water']?:0,
        'nights'  => $_GET['nights']?:0,
        'education'  => $_GET['edu']?:0,
        'medical'  => $_GET['med']?:0,
        'we'  => $_GET['we']?:0,
        'food'  => $_GET['food']?:0,
    ];
    return view('payment',['row' => $data]);
});



Route::post('/payment/add','App\Http\controllers\PaymentController@store');

Route::post('/payment','App\Http\controllers\PaymentController@submitPay');
Route::get('/account/all','App\Http\controllers\PaymentController@indexAll');
