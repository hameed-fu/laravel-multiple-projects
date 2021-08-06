<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Input;

// use Illuminate\Support\Facades\Redis;

class MessageController extends Controller
{
    public function send(){
        // $message = Request::all();
        // dd($message);
        // Message::create($message);
        // return true;
        
   }
   public function postCreate(Request $request){

    
    //     $arr['name'] = $request->get('name');
    //    $arr['email'] = $request->get('email');
    //    $arr['subject'] = $request->get('subject');
    //    $arr['message'] = $request->get('message');

    
        \DB::table('message')->insert([
            'message' => $request->get('message')
        ]);
        $redis = Redis::connect();
        $redis->publish('userChat',$request->get('message'));
        $arr['success'] = true;


       return json_encode($arr);

}

   
   
}
