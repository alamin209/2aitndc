<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    protected $fillable=[
        'name','companey_name','address'
    ];
    public  $timestamps =false;
}
