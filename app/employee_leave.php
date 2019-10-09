<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee_leave extends Model
{
    protected $fillable = [
        'leave_type','from_date','to_date','pay','not_pay_to_date','not_pay','not_pay_from_date','employee_id','reason','date','abs_duduct_amount','inco_type','inco_cat','user_id','update_user_id'
    ];
    public $timestamps = false;
}
