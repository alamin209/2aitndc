<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Std_bill_type extends Model
{
    public $timestamps=false;
    protected $fillable=['bill_type_name','status'];
}
