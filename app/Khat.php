<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Khat extends Model
{
    protected $primaryKey = 'khat_id';
    protected $fillable = [
        'khattype', 'upangsho_id', 'serilas', 'tax_type_id', 'tax_type_type_id', 'khat_name','status',
    ];
	
	
}
