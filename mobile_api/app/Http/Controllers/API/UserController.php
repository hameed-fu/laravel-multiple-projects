<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\UserMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Mail\PasswordResetMail;
use App\Http\Requests\Users\Login;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CheckID;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Users\Register;
use App\Http\Requests\Users\ChangePassword;
use App\Http\Requests\Users\ForgotPassword;

class UserController extends Controller
{
    public function register(Register $request){
        $user = User::create([
           'fname'   => $request->input('firstname'),
           'lname'   => $request->input('lastname'),
           'mobile'   => $request->input('mobile'),
           'email'      => $request->input('email'),
           'password'   => \Hash::make($request->input('password')),
       ]);       
       \Mail::to($user->email)->send(new UserMail($user));
       return $user ? response()->json(['message'=>'You have been registered successfully ! An activation link has been sent to '.$user->email,'data'=> $user ],200): response()->json(['message'=>'Failed to create your account !'],422);
       
    }

    public function login(Login $request)
    {
        $user = User::where(['email'=> $request->email])->first();
        // dd($user);
        if ($user) 
        {
            if ($user['status'] == true) {
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
            return response()->json(['message'=> 'User not found!'],404);
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
    // public function GetSingleUser(CheckID $request){
    //     $user = \DB::select("SELECT * FROM getsingle_user('$request->userid')");
    //     $user = [
    //         "user_id"   => $user[0]->user_id,
    //         "username"  => $user[0]->username,
    //         "email"     => $user[0]->email,
    //         "status"    => $user[0]->status
    //     ];
    //     return $user ? response()->json(['message'=> 'user listed succesully','data' => $user],200) :response()->json(['message'=> 'user not found!'],404);
    // }

    public function forgotPassword(ForgotPassword $request){
        if(User::where('email',$request->email)->doesntExist()){
            return response()->json(['message' => 'Email does not exist']);
        }else{
            if($this->checkLimitation($request->email) >= 4){
                try {
                    $user = User::where('email',$request->email)->first();
                    $password_reset = PasswordReset::create([
                        'userid'        => $user->id,
                        'tokenexpiry'   => Carbon::now(),
                        'dts'           => Carbon::now(),
                        'resettoken'    => Str::random(10)
                    ]);
                    if($password_reset){
                        // Mail::to($user->email)->send(new PasswordResetMail($password_reset->resettoken,$password_reset->userid));
                        return response()->json(['message' => 'Check your email to reset password']);
                    }else{
                        return response()->json(['message' => 'Something went wrong!']);
                    }
                }catch(Exception $exception) {
                    return response()->json(['message' => $exception->getMessage()]);
                }
            }else{
                $diff=4-$this->checkLimitation($request->email);
                return response()->json(['message' => 'Try again after '.$diff.' minute' ]);
            }
        }
    }

    public function checkLimitation($email){
        $user = DB::table('users')->where('email',$email)->first();
        $dts  = PasswordReset::where('userid',$user->id)->orderBy('dts','DESC')->limit(1)->value('dts');
        return $dts?Carbon::now()->diffInMinutes($dts):5;
    }

    public function changePassword(ChangePassword $request){
        $user = DB::table('password_resets')->where('resettoken',$request->resettoken)->get();
        if($user){
            $diffrence = Carbon::now()->diffInHours($user[0]->tokenexpiry);
            if($diffrence < 12){
                $user = User::find($user[0]->userid);
                $user->password = Hash::make($request->password);
                $userdata = $user->save();
                if($userdata){ // when user change password successfully the token will update null
                //    $reset = DB::table('passwordreset')->where('userid',$user->id)->first();
                    DB::table('password_resets')->where('userid',$user->id)->update(['resettoken' => ""]);
                    return response()->json(['message' => 'Password Chanaged successfully']);
                }
            }else{
                return response()->json(['message' => 'Your reset password time is expired, please try again']);
            }
        }else{
            return response()->json(['message' => 'Something went wrong!']);
        }
    }

}
