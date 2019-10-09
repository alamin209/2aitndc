<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salaryprogress extends Model
{
    protected $fillable = [
        'pid', 'emp_id', 'salary_add','gross_salary','salary_deduct','salary_month','process_date','incometax','lninstall'
        ,'allownce','convence','medcal','hrent','abs_duduct_amount','bsce_contri','empl_contri','echeck_number','dig_id'
    ];
}
