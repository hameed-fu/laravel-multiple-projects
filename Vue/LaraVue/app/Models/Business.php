<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'contact',
        'country',
        'city',
    ];

    public $table = 'business';

    protected $primaryKey = 'business_id';

    public $incrementing = false;

    // public $timestamps = false;
}
