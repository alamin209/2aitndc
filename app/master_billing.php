<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class master_billing extends Model
{
    protected $fillable = [

        'idcard', 'nonduereg', 'examfee', 'transcript', 'admission', 'whole_tuition','libarycosion_money','misc','idcard',
        'library_fee','exam_center_fee','com_lab_fee','admission','session_charge'
    ];

    public $timestamps = false;

}
