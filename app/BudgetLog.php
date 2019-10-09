<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

class BudgetLog extends Model
{
     
	static protected $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
	static protected $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    protected $primaryKey = 'bdgtlog_id';
	protected $fillable = [
         
         	'budget_id' ,	'year' ,	'amount' 
    ];
	
	
}
