<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'rol_id','add_full_name','emp_id','date_birth','dep_id','dig_id','emp_type','gross_salary','user_id',
        'appointed_date','joining_date','marital_status','add_mobile','father_name','mother_name','login_user_id','update_user_id',
        'emrgemcy_contact','sign_upload','photo_upload','present_address','permenet_address','add_email','add_religin',
        'cv_upload','reporting_to','gender','amount','abs_duduct_amount','account_no','probition_confor_date','probition_date'
    ];
}
