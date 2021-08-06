<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id = null)
    {
        $messages=[];
        $otherUser=null;
        if($id){
            $otherUser = User::find($id);
            $group_id = (Auth::user()->id>$id)?Auth::user()->id.$id:$id.Auth::user()->id;
            $messages = Messages::where('group_id',$group_id)->get();
        }
        $users = User::where('id','!=',Auth::user()->id)->get();
        return view('home',compact('users','messages','otherUser','id'));
    }
}
