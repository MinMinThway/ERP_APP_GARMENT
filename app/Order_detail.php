<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    //
    protected $fillable = [
    	'qty','price','UOM','warehouse_id','order_id',
    ];
}
