<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [

        'subject_name',
    ];

    public static function getDegree($degree_id){


    }

}




