<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;
use App\Warehouse;
class Order_detail extends Model
{
    //
    protected $fillable = [
    	'qty','price','UOM','warehouse_id','order_id',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
