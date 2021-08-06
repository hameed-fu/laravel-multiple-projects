<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BusinessUser;
use Illuminate\Http\Request;
use App\Http\Requests\Users\Register as Store;
use Illuminate\Support\Facades\Storage;

class BusinessUserController extends Controller
{
    public function indexAll($businessid){
        $data = \DB::select(\DB::raw("SELECT * FROM getallbusinessusers(:businessid)"),['businessid' => $businessid]);
        $b_users=[];
        foreach ($data as $row) {
            $b_users[] = [
            "user_id"       => $row->user_id,
            "username"      => $row->username,
            "member_id"     => $row->username,
            "member_type"   => $row->member_type,
            "user_email"    => $row->user_email,
            "user_status"   => $row->user_status,
            "business_id"   => $row->business_id,
            "business_name" => $row->business_id,
            "user_image"    => $row->user_image? asset($row->user_image):null
            ];
        }

        return $b_users ? response()->json(['message' => 'Business user listed successfully','data' => $b_users],200): response()->json(['message' => 'No record found!'],404);
    }

    public function store(Store $request)
    {
        if($request->hasFile('image')){
            $FileName = time().".".$request->image->getClientOriginalExtension();
            $file     = $request->image->move('users',$FileName);
            }
            else{
                $file = null;
            }
        
        $req = [
            'user_id'    => \Auth::user()->id,
            'username'   => $request->username,
            'email'      => $request->email,
            'password'   => \Hash::make($request->password),
            'image'      => $file
        ];
        
        $b_user = \DB::select(\DB::raw("SELECT * FROM create_businessuser(:user_id,:username,:email,:password,:image)"),$req);
        return $b_user? response()->json(['message' => 'Business added!','data' => $b_user],200): response()->json(['message' => 'Faied to add business user'],400);
    }

}
