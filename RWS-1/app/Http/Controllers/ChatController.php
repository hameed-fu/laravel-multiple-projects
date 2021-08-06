<?php

namespace App\Http\Controllers;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
 
class ChatController extends Controller {
	// public function __construct()
	// {
	// 	$this->middleware('guest');
	// }
	public function sendMessage(){
		$redis = Redis::connection();
		// $data = ['message' => $_POST['message']];
		// $redis->set("userChat",$_POST['message']);
		// $redis->publish('userChat', $_POST['message']);
		// return $redis->get("userChat");
		
   	$redis->publish('message', json_encode("hello redis"));
		return response()->json([]);
	}
}