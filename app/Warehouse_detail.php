<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse_detail extends Model
{
    //
    protected $fillable = [
    	'date','input_qty','output_qty','warehouse_id',
    ];
}
