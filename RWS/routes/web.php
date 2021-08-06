<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\LRedis;
// use Request;

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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group(['middleware' => 'web'], function () {
//     Route::auth();
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
// });
Route::post('sendMessage', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name("sendMessage");






Route::get('/check', function () {
    // $ch = curl_init();

    // // set url
    // curl_setopt($ch, CURLOPT_URL, "https://api.blockcypher.com/v1/eth/main/txs/8f39fb4940c084460da00a876a521ef2ba84ad6ea8d2f5628c9f1f8aeb395342");

    // //return the transfer as a string
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // // $output contains the output string
    // $output = curl_exec($ch);

    // // close curl resource to free up system resources
    // curl_close($ch); 
    // $redis = Redis::connection();
    $data = Redis::get('key1');
    
    if(isset($data)) {
        $output = json_decode($data, FALSE);

        return response()->json([
            'status_code' => 201,
            'message' => 'Fetched from redis',
            'data' => $output,
        ]);
    }else {
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "example.com");
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);
        // close curl resource to free up system resources
        curl_close($ch); 

        $redis->set('key1', $output);

        return response()->json([
            'status_code' => 201,
            'message' => 'Fetched from database',
            'data' => $output,
        ]);
    }
});

