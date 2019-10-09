<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class year_exp_type extends Model {

    protected $fillable = [
        'type', 'date'
    ];
    public $timestamps = false;

}
