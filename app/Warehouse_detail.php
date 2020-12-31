<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Warehouse;
class Warehouse_detail extends Model
{
    //
    protected $fillable = [
    	'date','input_qty','output_qty','warehouse_id',
    ];
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
}
