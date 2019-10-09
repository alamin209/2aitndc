<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventorysucategory extends Model
{
    protected $fillable = [
        'cat_id', 'sub_cate_name', 'note'
    ];

    public $timestamps = false;
	
	public function invcat(){
        
		return $this->belongsTo(inventorycatagory::class,'cat_id','id');
    }
	

}
