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
    // return $output;
    // $redis = Redis::connection();
    



    $cachedBlog = Redis::get('blog_');


    if(isset($cachedBlog)) {
        $output = json_decode($cachedBlog, FALSE);

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
        Redis::set('blog_' . $id, $output);

        return response()->json([
            'status_code' => 201,
            'message' => 'Fetched from database',
            'data' => $blog,
        ]);
    }
});
