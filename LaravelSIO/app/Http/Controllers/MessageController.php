<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MyEvent;

class MessageController extends Controller
{
    public function sendMessage(Request $request){
        $message = $request->message;
        event(new MyEvent($message));
        return response()->json('Message has been sent!');
    }
}
