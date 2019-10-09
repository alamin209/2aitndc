<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $fillable = [
        'course_credit','course_code','degree_id','sub_id','sem_id','course_name','lab_mark','course_mark',
        'lab_credit'
    ];
    public $timestamps = false;
}
