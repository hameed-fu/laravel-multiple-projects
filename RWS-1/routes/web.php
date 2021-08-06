<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
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
    // Redis::publish('message',"Hello redis");
    return view('welcome');
});
// Route::post('/send', function (Request $request) {
//         $redis = Redis::connection();
//         $redis->set("message",Request::input('message'));
//         return $redis->get("message");
// 		$data = ['message' => Request::input('message'), 'user' => Request::input('user')];
// 		$redis->publish('message', json_encode($data));
// 		return response()->json([]);
// });


Auth::routes();

Route::get('/home/{id?}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group(['middleware' => 'web'], function () {
//     Route::auth();
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
// });


Route::get('/check', function () {
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

