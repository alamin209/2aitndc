<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxTypeType extends Model
{
    protected $primaryKey = 'tax_id';
    protected $fillable = [
	
        'upangsho_id', 'khat_id', 'khtattype_id', 'tax_name2', 'status'
    ];
	
		
}
