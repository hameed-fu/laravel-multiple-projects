<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Messages extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id','receiver_id ','subject','message','read'
    ];

    protected $appends = ['sender','reveiver'];

    public function gerSenderAttribute(){
        return User::where('id',$this->sender_id)->first();
    }

    public function gerReceiverAttribute(){
        return User::where('id',$this->receiver_id)->first();
    }

    public function getAtAttribute($value){
        return Carbon::parse($value)->diffForHumans();
    }
}
