<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdjunicTeacher extends Model
{
    protected $fillable = [
        'emp_id', 'sub_id', 'degree_id', 'sem_id', 'course_id','session_id','batch_id',
        'current_position', 'lecture_no', 'lecture_duration', 'total_payment','sub_id'
    ];
}
