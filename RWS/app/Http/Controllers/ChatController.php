<?php

namespace App\Http\Controllers;
// use LRedis;
use Request;
use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
 
class ChatController extends Controller {
	
	public function sendMessage(Request $request){
		$attributes = [
            'message' => request()->input('message'),
            // 'sender_id' => request()->user()->id,
            // 'receiver_id' => request()->input('receiver_id'),
            // 'subject' => request()->input('subject'),
            // 'read' => 0,
        ];
        
        $pm = Message::create($attributes);
        $data = Message::where('id', $pm->id)->first();

        Redis::connection();
        Redis::set("message",$data);
        Redis::publish('message', $data);

        return response(['data' => Redis::get('message')], 201);
		
   
	}
}