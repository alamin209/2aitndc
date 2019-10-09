<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trx_records_shuki extends Model
{
    protected $fillable = [

       'table_id','table_incrment_id','amount_type','amount','trx_date','pay_type','acount_details_id',
        'branchid','salary_month'
    ];
}
