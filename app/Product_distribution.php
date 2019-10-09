<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_distribution extends Model
{
    protected  $fillable=['product_id','empl_id','product_id','remark','distibuted_qty','user_id','date_ofdistribution'];

    public $timestamps=false;
}
