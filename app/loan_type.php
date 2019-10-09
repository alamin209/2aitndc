<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loan_type extends Model
{
    protected  $fillable=['loan_name'];

    public $timestamps=false;
}
