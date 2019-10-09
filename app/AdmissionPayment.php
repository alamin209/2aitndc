<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmissionPayment extends Model {

    protected $fillable = [
        'sl_no', 'slip_date', 'name_of_applicant', 'amount', 'created_at','inco_cat','inco_type','user_id',
        'updated_at', 'amount_type', 'branch_id', 'account_id', 'sessions', 'degree', 'subjects'
    ];

}
