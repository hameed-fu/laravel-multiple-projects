<?php

use Illuminate\Support\Facades\Route;

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
        // $ch = curl_init();

        // // set url
        // curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.cypress.io/todos");

        // //return the transfer as a string
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // // $output contains the output string
        // $output = curl_exec($ch);

        // // close curl resource to free up system resources
        // curl_close($ch); 
        // $data = json_decode($output);
    return view('welcome');
});
