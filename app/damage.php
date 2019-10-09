<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class damage extends Model
{
    protected  $fillable=['sup_id','cat_id','sub_cat','prodct_id','remark','qty'];

    public $timestamps=false;
}
