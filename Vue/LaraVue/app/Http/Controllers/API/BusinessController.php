<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Requests\Business\Store;
use App\Http\Requests\Business\Update;
use App\Http\Requests\Business\CheckID;

class BusinessController extends Controller
{
    public function store(Store $request){
        $req = [
            'name'    => $request->name,
            'email'   => $request->email,
            'address' => $request->address,
            'contact' => $request->contact,
            'country' => $request->country,
            'city'    => $request->city,
            'user_id' => $request->userid,
        ];
        $business = \DB::select(\DB::raw("SELECT * FROM create_business(:name,:email,:address,:user_id,:contact,:country,:city)"),$req);
        return $business ? response()->json(['message' => 'Business created!','data' => $business],200): response()->json(['message' => 'Failed to create business'],400);
    }
    public function getUserBusiness(CheckID $request){
        $business = \DB::select("SELECT * FROM getsingle_business(:user_id)",['user_id' => $request->userid]);
        return $business ? response()->json(['message' => 'Business listed successfully!','data' => $business],200): response()->json(['message' => 'No record found'],404);
    }
    public function update(Update $request){
        $req = [
            'name'    => $request->name,
            'address' => $request->address,
            'contact' => $request->contact,
            'country' => $request->country,
            'city'    => $request->city,
            'businessid'    => $request->businessid,
        ];
        $business = \DB::select(\DB::raw("SELECT * FROM update_business(:businessid,:name,:address,:contact,:country,:city)"),$req);
        return $business ? response()->json(['message' => 'Business updated!','data' => $business],200): response()->json(['message' => 'Failed to update business'],400);
    }

    public function testFunction(){
        return reponse()->json(['message' => 'Check success with token']);
    }

}
