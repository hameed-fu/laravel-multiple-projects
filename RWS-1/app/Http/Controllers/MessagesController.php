<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function getUserNotifications(Request $request){
        $notifications = Messages::where('read',0)
        ->where('recevier_id',$request()->user()->id)
        ->orderBy('created_at','desc')
        ->get();
        return response(['data' => $notifications],200);
    }

    public function getPrivateMessages(Request $request){
        $messages = Messages::where('receiver_id',$request()->user()->id)
        ->orderBy('created_at','desc')
        ->get();
        return response(['data' => $messages],200);
    }
    
    public function getUserNotificationById(Request $request){
        $message = Messages::where('id',$request->receiver_id)->first();
        if($message->read == 0){
            $message->read = 1;
            $message->save() ;
        }
        return response(['data' => $message],200);
    }
    
    public function getUserNotificationSent(Request $request){
        $messages = Messages::where('sender_id',$request()->user()->id)
        ->orderBy('created_at','desc')
        ->get();
        return response(['data' => $messages],200);
    }

    public function sendMessage(Request $request){
        $message = [
            'sender_id'     => $request->sender_id,
            'receiver_id'   => $request->receiver_id,
            'subject'       => $request->subject,
            'message'       => $request->message,
            'read'          => 0,
        ];
        $pm = Messages::where('id',$message->id);
        return response(['data' => $pm],200);
    }
}
