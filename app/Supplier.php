<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $fillable = [
    	'company_name','email','address','phone',
    ];
    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
