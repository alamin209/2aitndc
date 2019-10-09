<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model {

    protected $fillable = [
	
        'vcher', 'inco_cat', 'inco_type', 'pay_type', 'bank_id', 'branch_id', 'accountid', 'amount', 'note', 'date', 'paydate'
    ];
   

}
