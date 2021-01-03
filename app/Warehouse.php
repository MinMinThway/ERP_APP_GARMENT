<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Warehouse_detail;
class Warehouse extends Model
{
    //
    protected $fillable = [
    	'codeno','name','photo','stock_qty','UOM','order_time_duration','stock_safety_factor','reorder_date',
    ];
	public function details()
    {
      return $this->hasMany('App\Warehouse_detail');
    }
}
