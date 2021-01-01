<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order_detail;
use App\Supplier;
class Order extends Model
{
    //
    protected $fillable = [
    	'date','invoice_no','cheque_no','total','denile_note','account_id','supplier_id','status_id',
    ];

    public function detail()
    {
        return $this->hasMany(Order_detail::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
