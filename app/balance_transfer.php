<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class balance_transfer extends Model {

    protected $fillable = [
        'payment_type', 's_bank', 's_bank_branch', 's_bank_act', 't_bank', 't_bank_branch', 't_bank_act', 'amount', 'cheque', 'note', 'trnsferdate'
    ];
    public $timestamps = false;

}
