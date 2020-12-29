<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    //
    protected $fillable = [
    	'codeno','name','photo','stock_qty','UOM','order_time_duration','stock_safety_factor',
    ];
}
