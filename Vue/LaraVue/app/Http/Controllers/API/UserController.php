<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Users\Register;
use App\Http\Requests\Users\Login;
use App\Http\Requests\Users\CheckID;

class UserController extends Controller
{
    public function register(Register $request){
        $user = User::create([
           'id'         => \Str::uuid(),
           'username'   => $request->input('username'),
           'email'      => $request->input('email'),
           'password'   => \Hash::make($request->input('password')),
       ]);
       return response()->json(['message' => 'User registerd!','data' => $user],200);
    }

    public function login(Login $request)
    {
        $user = User::where(['email'=> $request->email])->first();
        if ($user) 
        {
            if ($user['status'] === true) {
                if (!\Hash::check(request()->password, $user->password)) {
                    return response()->json(['message'=> 'Incorrect email or passwrod'],400);
                }
                \Auth::login($user);
                $token = $user->createToken('access_token')->accessToken;
                $user['access_token'] = $token;
                return $user ? response()->json(['message'=>'Logged in successfully','data'=> $user],200): response()->json(['message'=>'Failed to login'],400);
            }else{
                return response()->json(['Status' => false,'ErrorCode' => 400,'message'=> 'Your account is not active. please contact to admin for activation'],400);
            }
        }
        else {
            return response()->json(['message'=> 'user not found!'],404);
        }
    }
    public function verify($userid) {
        $user = User::find($userid);
        if($user->status ===  false){
            $user->status = true;
            $user->email_verified_at = \Carbon\Carbon::now();
            $verified = $user->save();
           return $verified ? response()->json(['message'=>'User Verified Successfully'],200): response()->json(['message'=>'Failed to verify user'],400);
        } else {
            return response()->json(['message'=>'User already verified'],200);
        }
    }
    public function GetSingleUser(CheckID $request){
        $user = \DB::select("SELECT * FROM getsingle_user('$request->userid')");
        $user = [
            "user_id"   => $user[0]->user_id,
            "username"  => $user[0]->username,
            "email"     => $user[0]->email,
            "status"    => $user[0]->status
        ];
        return $user ? response()->json(['message'=> 'user listed succesully','data' => $user],200) :response()->json(['message'=> 'user not found!'],404);
    }

    public function update(Request $request,$userid){
        $user = User::find($userid);
        $user->username = $request->username;
        $user->updated_at = now();
        $updated = $user->update();
        return $updated? response()->json(['message' => 'User updated!','data' => $user],200):response()->json(['message' => 'Failded to updated!'],400);
    }

}
