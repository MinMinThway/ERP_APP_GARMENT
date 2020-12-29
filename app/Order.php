<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
    	'date','invoice_no','cheque_no','total','denile_note','account_id','supplier_id','status_id',
    ];
}
