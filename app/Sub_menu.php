<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sub_menu extends Model
{
    //
     //
    protected $fillable = [
        'menu_id', 'sub_menu_name', 'url','status'
    ];
}
