<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\ChatEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function chat(){
        return view("chat");
    }
    public function send(Request $request){
        $user = User::find(Auth::id());
        $this->saveToSession($request);
        event(new ChatEvent($request->message,$user));
        return "ok";
    }
    public function saveToSession(Request $request){
        \Session::put('chat',$request->chat);
    }

    public function getOldMessage(){
        return \Session::get('chat');
    }
}
