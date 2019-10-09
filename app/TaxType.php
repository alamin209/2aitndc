<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxType extends Model
{
    protected $primaryKey = 'tax_id';
    protected $fillable = [
	
        'upangsho_id', 'khat_id', 'subormain', 'tax_name', 'status'
    ];
	
		
}
