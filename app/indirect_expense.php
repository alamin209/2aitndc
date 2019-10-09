<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indirect_expense extends Model {

    protected $fillable = [
	
        'voucher', 'exp_cat', 'exp_type', 'pay_type', 'bank_id', 'branch_id', 'accountid', 'amount', 'note', 'date', 'paydate'
    ];
     

}
