<?php

namespace App;
use App\Account_detail;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
    	'bank','type','acc_number','balance',
    ];

    public function accountdetails()
    {
      return $this->hasMany(' App\Account_detail');
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
