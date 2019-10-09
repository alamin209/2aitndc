<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employeloan extends Model
{
    protected  $fillable=['dep_id','desig_id','employ_id','loan_type','amount','branch_id','bankact','mon_inst','loan_date'];

    public $timestamps=false;

}
