<?php

use Illuminate\Support\Facades\Route;

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

Route::post('/payment','App\Http\controllers\PaymentController@submitPay');


Route::get('/account/all',[App\Http\Controllers\PaymentController::Class,'indexAll']);
Route::post('/payment/add', [App\Http\Controllers\PaymentController::Class,'store']);

