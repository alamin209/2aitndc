<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventorycatagory extends Model
{
    protected $fillable = [
	
        'depricit', 'catgeory_name', 'status'
    ];

    public $timestamps = false;
	
	public function invsubcat(){
        
		return $this->belongsTo(inventorycatagory::class,'cat_id','id');
    }
}