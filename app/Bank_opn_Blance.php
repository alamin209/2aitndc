<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank_opn_Blance extends Model
{
    //
      protected $fillable = [
        'bank_details_id', 'amount','date', 'status',
    ];
}
